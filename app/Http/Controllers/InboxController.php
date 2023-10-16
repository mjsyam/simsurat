<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Utils\ErrorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Auth;
use App\Models\LetterHistory;
use App\Models\LetterReceiver;
use App\Models\User;
use App\Models\Role;
use App\Models\Letter;
use App\Models\DispositionInformation;
use App\Models\Disposition;
use App\Models\DispositionTo;
use App\Models\Information;

class InboxController extends Controller
{

    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

    public function index() {

        // $letters = DB::table('letters')
        // ->join('letter_receivers', 'letter_receivers.letter_id', '=', 'letters.id')
        // ->join('users', 'letters.user_id', '=', 'users.id')
        // ->leftJoin('dispositions', 'letter_receivers.disposition_id', '=', 'dispositions.id')
        // ->leftJoin('disposition_to', 'dispositions.id', '=', 'disposition_to.disposition_id')
        // ->where('letter_receivers.user_id', Auth::user()->id)
        // ->orWhere('letter_receivers.disposition_id', Auth::user()->id)
        // ->orWhere('disposition_to.role_id', Auth::user()->roles->first()->id)
        // ->get();

        // dd($letters);
        return view("inbox.index");
    }

    public function tableInbox() {

        if (request()->ajax()) {

            // $letters = DB::table('letters')
            // ->select(['*', 'letters.id as letter_id'])
            // ->join('letter_receivers', 'letter_receivers.letter_id', '=', 'letters.id')
            // ->join('users', 'letters.user_id', '=', 'users.id')
            // // ->leftJoin('dispositions', 'letter_receivers.disposition_id', '=', 'dispositions.id')
            // // ->leftJoin('disposition_to', 'dispositions.id', '=', 'disposition_to.disposition_id')
            // ->where('letter_receivers.user_id', Auth::user()->id)
            // // ->orWhere('disposition_to.role_id', Auth::user()->roles->first()->id)
            // // ->orWhere('letter_receivers.disposition_id', Auth::user()->id)
            // ->get();

            $letters = Letter::with(['letterReceivers', 'user', 'dispositions.dispositionTos'])
            ->whereHas('letterReceivers', function ($q){
                return $q->where('user_id', Auth::user()->id);
            })->orWhereHas('dispositions.dispositionTos', function($q){
                return $q->where('role_id', Auth::user()->roles->first()->id);
            })
            ->get();

            return DataTables::of($letters)
            ->addColumn('title', function($letter) {
                return $letter->title;
            })
            ->addColumn('name', function($letter) {
                return $letter->user->name;
            })
            ->addColumn('email', function($letter) {
                return $letter->user->email;
            })
            ->addColumn('action', function ($letter) {
                $detail = '
                <li>
                    <div class="btn-detail">
                        <a href="/inbox/detail/'. $letter->id .'" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
                    </div>
                </li>
                ';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$detail.'
                </ul>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function detail(Letter $letter){
        $letterReceiver = LetterReceiver::where('user_id', Auth::user()->id)->where('letter_id', $letter->id)->first();
        $disposition = $letterReceiver->disposition;
        // dd($letterReceiver->disposition);
        
        if(Auth::user()->roles->first()->children != null){
            $roleIds = Auth::user()->roles->first()->children->pluck("id");
        }

        if(Auth::user()->roles->first()->parent != null){
            $parentIds = collect(Auth::user()->roles->first()->parent_id);
            $roleIds = $roleIds->concat($parentIds);
        }

        $roles = Role::whereIn('id', $roleIds)->get();
        
        $users = User::whereHas('roles', function ($query) use ($roleIds) {
            $query->whereIn('roles.id', $roleIds);
        })->get();
        
        if($roles->count() == 1 ) {
            $role1 = $roles;
            $role2 = null;
        } elseif ($roles->count() >= 2) {
            list($role1, $role2) = $roles->split(2);
        } else {
            $role1 = null;
            $role2 = null;
        }

        $dispositionTos = Disposition::where('letter_id', $letter->id)->first()->dispositionTos;
        $information = Information::all();
        list($information1, $information2) = $information->split(2);

        $isRead = LetterHistory::where('letter_receiver_id', $letterReceiver->id)->where('status', $this->constants->letter_status[2])->first();
        if (!$isRead) {
            LetterHistory::create([
                'letter_receiver_id' => $letterReceiver->id,
                'note' => 'Surat telah dibaca oleh ' . Auth::user()->name . ' pada ' . Carbon::now()->format('Y-m-d H:i:s'),
                'status' => $this->constants->letter_status[2],
            ]);
            $letterReceiver->letterStatus()->update([
                'status' => $this->constants->letter_status[2],
                'read' => 1,
            ]);

        }
        
        return view('inbox.detail', compact(['users', 'letter', 'letterReceiver', 'role1', 'role2', 'information1', 'information2', 'disposition']));
    }

    public function disposition(LetterReceiver $letterReceiver, Request $request){
        $users = User::select('id', 'name')->get();

        $disposition = Disposition::create([
            'letter_id' => $letterReceiver->letter->id,
            'security_level' => $security_level,
            'agenda_number' => $request->agenda_number,
            'receive_date' => $request->receive_date,
            'purpose' => $request->purpose,
            'from' => $request->from,
            'point' => $request->point,
            'information' => $request->description,
            'intended_person' => $request->intended_person,
        ]);

        foreach($request->disposition_to as $dispositionTo){
            $DispotionTo = DispositionTo::create([
                'disposition_id' => $disposition->id,
                'role_id' => $dispositionTo,
                'user_id' => 1
            ]);
        }

        foreach($request->information as $information){
            $dispositionInformation = DispositionInformation::create([
                'disposition_id' => $disposition->id,
                'information_id' => $information,
            ]);
        }

        $letterReceiver->update([
            'disposition_id' => $disposition->id,
        ]);

        
        LetterHistory::create([
            'letter_receiver_id' => $letterReceiver->id,
            'note' => 'Surat didisposisikan kepada ' . $letterReceiver->disposition->name . ' pada ' . Carbon::now()->format('Y-m-d H:i:s'),
            'status' => $this->constants->letter_status[3],
        ]);



        $letterReceiver->letterStatus()->update([
            'status' => $this->constants->letter_status[3],
        ]);
        
        return redirect()->back()->with('success', 'disposisi berhasil')->with(compact('users', 'letterReceiver'));
    }
}
