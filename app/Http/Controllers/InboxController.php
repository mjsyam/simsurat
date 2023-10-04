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
use App\Models\Letter;

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
        return view("inbox.index");
    }

    public function tableInbox() {
        if (request()->ajax()) {

            $letters = DB::table('letters')
            ->join('letter_receivers', 'letter_receivers.letter_id', '=', 'letters.id')
            // ->join('letter_statuses', 'letter_receivers.id', '=', 'letter_statuses.letter_receiver_id')
            ->join('users', 'letters.user_id', '=', 'users.id')
            ->where('letter_receivers.user_id', Auth::user()->id)
            ->orWhere('letter_receivers.disposition_id', Auth::user()->id)
            ->get();

            return DataTables::of($letters)
            ->addColumn('action', function ($action) {
                $detail = '
                <li>
                    <div class="btn-detail">
                        <a href="/inbox/detail/'. $action->letter_id .'" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
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
        $letterReceiver = LetterReceiver::where('user_id', Auth::user()->id)->orWhere('disposition_id', Auth::user()->id)->first();
        
        if(Auth::user()->roles->first()->children != null){
            $roleIds = Auth::user()->roles->first()->children->pluck("id");
        }

        if(Auth::user()->roles->first()->parent != null){
            $parentIds = collect(Auth::user()->roles->first()->parent_id);
            $roleIds = $roleIds->concat($parentIds);
        }

        $users = User::get();
        
        $users = User::whereHas('roles', function ($query) use ($roleIds) {
            $query->whereIn('roles.id', $roleIds);
        })->get();
        
        // dd($letterReceiver->user_disposition);
        
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
        return view('inbox.detail', compact(['users', 'letter', 'letterReceiver']));
    }

    public function disposition(LetterReceiver $letterReceiver, Request $request){
        $users = User::select('id', 'name')->get();
        $letterReceiver->update([
            'disposition_id' => $request->disposition_id,
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
