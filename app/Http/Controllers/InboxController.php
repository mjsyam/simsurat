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

            // $letters = Letter::with(['letterReceivers', 'user', 'dispositions.dispositionTos'])
            // ->whereHas('letterReceivers', function ($q){
            //     return $q->where('user_id', Auth::user()->id);
            // })->orWhereHas('dispositions.dispositionTos', function($q){
            //     return $q->where('role_id', Auth::user()->roles->first()->id);
            // })
            // ->get();

            $letterReceivers = LetterReceiver::where('user_id', Auth::user()->id)
            ->orWhereHas('disposition.dispositionTos', function($q){
                $q->whereIn('role_id', Auth::user()->identifiers->pluck('role_id'));
            })->with(['letter', 'user', 'disposition.dispositionTos']);

            // dd($letterReceivers);

            return DataTables::of($letterReceivers)
            ->addColumn('title', function($letterReceivers) {
                return $letterReceivers->letter->title;
            })
            ->addColumn('name', function($letterReceivers) {
                return $letterReceivers->letter->user->name;
            })
            ->addColumn('email', function($letterReceivers) {
                return $letterReceivers->letter->user->email;
            })
            ->addColumn('action', function ($letterReceivers) {
                $detail = '
                <li>
                    <div class="btn-detail">
                        <a href="/inbox/detail/'. $letterReceivers->id .'" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
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


    public function detail(LetterReceiver $letterReceiver){
        $letter = $letterReceiver->letter;
        $disposition = $letterReceiver->disposition;
        // dd($letterReceiver);
        $roleIds = [];

        if(Auth::user()->identifiers->first()->role->children){
            $roleIds = Auth::user()->identifiers->first()->role->pluck("id");
            $roleIds = $this->getChildRoleIds($roleIds);
        }

        if(Auth::user()->identifiers->first()->role->parent){
            $parentIds = Auth::user()->identifiers->first()->role->parent;
            if( $parentIds){
                $uncleIds = $parentIds->children()->pluck("id")->toArray();
                $roleIds = array_merge($roleIds, $uncleIds);
            }
            $roleIds[] = $parentIds->id;
        }

        // $roleIds = array_unique($roleIds);

        $roles = Role::whereIn('id', $roleIds)->get();
        
        $users = User::whereHas('identifiers', function ($query) use ($roleIds) {
            $query->whereIn('role_id', $roleIds);
        })->get();

        $role1 = null;
        $role2 = null;
        if($roles->count() == 1 ) {
            $role1 = $roles;
        } elseif ($roles->count() >= 2) {
            list($role1, $role2) = $roles->split(2);
        }
          
        
        $information = [
            "Ikuti Disposisi Mentri",
            "Proses Sesuai Prosedur",
            "Selesaikan",
            "Tanggapan/Suara Tertulis",
            "Pelajari",
            "Untuk Pertimbangan",
            "Perbaiki",
            "Siapkan dan Buatkan konsep/bahan",
            "Untuk Diketahui/ diperhatikan",
            "Check status perkembangan",
            "Laporkan",
            "Dibantu",
            "Dapat disetujui",
            "Temui saya",
            "Adakan rapat",
            "Jadwalkan/ ingatkan",
            "Kirimkan segera",
            "Fotokopi/ arsipkan",
            "Buatkan undangan",
            "Untuk digunakan/ ditindaklanjuti",
            "Tangani bersama",
            "Hadiri/ wakili",
        ];

        $split_point = count($information) / 2;
        $information1 = array_slice($information, 0, $split_point);
        $information2 = array_slice($information, $split_point);
        
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

        if($disposition){
            $dispositionTos = $disposition->dispositionTos->pluck('role_id');
            $informations = $disposition->DispositionInformations->pluck('information_id');
        } else{
            $dispositionTos = null;
            $informations = null;
        }

        // dd($information);
        return view('inbox.detail', compact([
            'users', 'letter', 'letterReceiver', 'role1', 'role2', 'informations', 'information1', 'information2', 'disposition', 'dispositionTos'
        ]));
    }

    public function disposition(LetterReceiver $letterReceiver, Request $request){
        // dd($letterReceiver);
        $users = User::select('id', 'name')->get();
        $disposition = Disposition::create([
            'letter_id' => $letterReceiver->letter->id,
            'security_level' => $request->security_level,
            'agenda_number' => $request->agenda_number,
            'receive_date' => $request->receive_date,
            'purpose' => $request->purpose,
            'from' => $request->from,
            'point' => $request->point,
            'information' => $request->description,
        ]);

        foreach($request->disposition_to as $dispositionTo){
            $DispotionTo = DispositionTo::create([
                'disposition_id' => $disposition->id,
                'role_id' => $dispositionTo,
                'user_id' => Auth::user()->id,
            ]);

            LetterHistory::create([
                'letter_receiver_id' => $letterReceiver->id,
                'note' => 'Surat didisposisikan kepada ' . Role::where("id", $dispositionTo)->first()->name . ' pada ' . Carbon::now()->format('Y-m-d H:i:s'),
                'status' => $this->constants->letter_status[3],
            ]);
        }


        foreach($request->information as $information){
            $dispositionInformation = DispositionInformation::create([
                'disposition_id' => $disposition->id,
                'information' => $information,
            ]);
        }


        $letterReceiver->update([
            "disposition_id" =>  $disposition->id,
        ]);

        $letterReceiver->letterStatus()->update([
            'status' => $this->constants->letter_status[3],
        ]);
        
        return redirect()->back()->with('success', 'disposisi berhasil')->with(compact('users', 'letterReceiver'));
    }

    private function getChildRoleIds($roleIds){
        $childRoleIds = Role::whereIn('parent_id', $roleIds)->pluck('id')->toArray();
        if (!empty($childRoleIds)) {
            $childRoleIds = array_merge($childRoleIds, $this->getChildRoleIds($childRoleIds));
        }
        return $childRoleIds;
    }
}
