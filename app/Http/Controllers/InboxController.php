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
use App\Service\WaBlast;
use Illuminate\Support\Facades\Notification;

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
            $letterReceivers = LetterReceiver::where('user_id', Auth::user()->id)
            ->whereHas('letterStatus', function ($query) {
                $query->whereNot('status', $this->constants->letter_status[0]);
            })
            ->with(['letter.letterCategory', 'user', 'disposition.dispositionTos'])->orderBy("created_at", "desc");

            // dd($letterReceivers);

            return DataTables::of($letterReceivers)
            ->addColumn('title', function($letterReceivers) {
                return $letterReceivers->letter->title;
            })
            // ->addColumn('security_level', function($letterReceivers) {
            //     return $letterReceivers->disposition->security_level;
            // })
            ->addColumn('signed', function ($letterReceiver) {
                return $letterReceiver->letter->signed->name;
            })
            ->addColumn('category', function ($letterReceiver) {
                return $letterReceiver->letter->letterCategory->name;
            })
            ->addColumn('created_at', function ($letterReceiver) {
                return $letterReceiver->letter->created_at;
            })
            ->addColumn('action', function ($letterReceivers) {
                $id = $letterReceivers->id;
                $letterId = $letterReceivers->letter->id;
                return view('inbox.components.menu', compact([
                    'id', 'letterId'
                ]));
            })
            ->addColumn('read', function ($query) {
                return $query->letterStatus->read;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function tableDipositionOutBox(Request $request) {
        $letterReceivers = LetterReceiver::where('user_id', Auth::user()->id)
            ->where('disposition_id', "!=", null)
            ->with(['letter.letterCategory', 'user', 'disposition.dispositionTos'])
            ->orderBy("created_at", "desc");

        if ($request->security_level !== "*") {
            $letterReceivers->whereHas('disposition', function($q) use ($request){
                $q->where('security_level', $request->security_level);
            });
        }

        return DataTables::of($letterReceivers)
            ->addColumn('title', function($letterReceivers) {
                return $letterReceivers->letter->title;
            })
            ->addColumn('security_level', function($query) {
                return $query->disposition->security_level;
                // $sql = "letterReceivers.disposition.security_level like ?";
                // $query->whereRaw($sql, ["%{$keyword}%"]);
                // return $query;
            })
            ->addColumn('signed', function ($letterReceiver) {
                return $letterReceiver->letter->signed->name;
            })
            ->addColumn('category', function ($letterReceiver) {
                return $letterReceiver->letter->letterCategory->name;
            })
            ->addColumn('created_at', function ($letterReceiver) {
                return Carbon::parse($letterReceiver->letter->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($letterReceivers) {
                $id = $letterReceivers->id;
                $letterId = $letterReceivers->letter->id;
                return view('inbox.components.menu', compact([
                    'id', 'letterId'
                ]));
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'security_level'])
            ->make(true);
    }

    public function tableDisposisitionInbox() {
        $letterReceivers = LetterReceiver::whereHas('disposition.dispositionTos', function($q){
            $q->whereIn('role_id', Auth::user()->identifiers->pluck('role_id'));
        })->with(['letter.letterCategory', 'user', 'disposition.dispositionTos'])->orderBy("created_at", "desc");

        return DataTables::of($letterReceivers)
            ->addColumn('title', function($letterReceivers) {
                return $letterReceivers->letter->title;
            })
            ->addColumn('security_level', function($query) {
                return $query->disposition->security_level;
                // $sql = "letterReceivers.disposition.security_level like ?";
                // $query->whereRaw($sql, ["%{$keyword}%"]);
                // return $query;
            })
            ->addColumn('signed', function ($letterReceiver) {
                return $letterReceiver->letter->signed->name;
            })
            ->addColumn('category', function ($letterReceiver) {
                return $letterReceiver->letter->letterCategory->name;
            })
            ->addColumn('created_at', function ($letterReceiver) {
                return Carbon::parse($letterReceiver->letter->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($letterReceivers) {
                $id = $letterReceivers->id;
                $letterId = $letterReceivers->letter->id;
                return view('inbox.components.menu', compact([
                    'id', 'letterId'
                ]));
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
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


        $roles = Role::whereIn('id', $roleIds)->get();
        $users = User::whereHas('identifiers', function ($query) use ($roleIds) {
            $query->whereIn('role_id', $roleIds);
        })->get();


        $security = $this->constants->security;
        $informations = $this->constants->informations;

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
            $dispositionStatus = $disposition->dispositionTos->where('role_id', Auth::user()->identifiers->first()->role->id)->first();
        } else{
            $dispositionTos = null;
            $dispositionStatus = null;
        }
        return view('inbox.detail', compact([
            'users', 'letter', 'letterReceiver', 'roles', 'informations', 'security', 'informations', 'disposition', 'dispositionTos', 'dispositionStatus'
        ]));
    }

    public function disposition(LetterReceiver $letterReceiver, Request $request){
        date_default_timezone_set('Asia/Makassar');

        $request->validate([
            'security_level' => 'required',
            // 'receive_date' => 'required',
            // 'purpose' => 'required',
            // 'from' => 'required',
            // 'point' => 'required',
            'description' => 'required',
        ]);

        $users = User::select('id', 'name')->get();
        $disposition = Disposition::create([
            'letter_id' => $letterReceiver->letter->id,
            'security_level' => $request->security_level,
            'receive_date' => date("Y/m/d"),
            'purpose' => date("Y/m/d"),
            'from' => Auth::user()->identifiers->first()->unit->name,
            'point' => $letterReceiver->letter->title,
            'information' => $request->description,
        ]);

        foreach($request->roles as $role){
            $role = DispositionTo::create([
                'disposition_id' => $disposition->id,
                'role_id' => $role,
                'user_id' => Auth::user()->id,
            ]);

            LetterHistory::create([
                'letter_receiver_id' => $letterReceiver->id,
                'note' => 'Surat didisposisikan kepada ' . Role::where("id", $role->role_id)->first()->name . ', Hal: ' . $disposition->information,
                'status' => $this->constants->letter_status[3],
            ]);
        }


        foreach($request->informations as $information){
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

    public function dispositionStatus(DispositionTo $dispositionTo, $status){
        DB::transaction(function() use ($dispositionTo, $status){
            $dispositionTo->update([
                'status' => $status
            ]);
            $letter = $dispositionTo->disposition->letter;
            $sender = $letter->user;
            $signed = $letter->signed;

            if ($status == 'approved') {
                WaBlast::send($sender->phone_number, $sender->name, $letter->title);
                Notification::send($sender, new \App\Notifications\MailNotification((object) [
                    'headers' => 'Disposisi Anda Telah Di Setujui',
                    'user' => $sender
                ]));

                WaBlast::send($signed->phone_number, $signed->name, $letter->title);
                Notification::send($signed, new \App\Notifications\MailNotification((object) [
                    'headers' => 'Disposisi Anda Telah Di Setujui',
                    'user' => $signed
                ]));
            }
        });

        return redirect()->back();
    }


    private function getChildRoleIds($roleIds){
        $childRoleIds = Role::whereIn('parent_id', $roleIds)->pluck('id')->toArray();
        if (!empty($childRoleIds)) {
            $childRoleIds = array_merge($childRoleIds, $this->getChildRoleIds($childRoleIds));
        }
        return $childRoleIds;
    }

    public function indexDisposition(){
        $security = $this->constants->security;
        return view("inbox.disposition", compact([
            'security'
        ]));
    }

    public function indexOutboxDisposition(){
        $security = $this->constants->security;
        return view("inbox.outbox-disposition", compact([
            'security'
        ]));
    }
}
