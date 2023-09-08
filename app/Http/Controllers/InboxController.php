<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use Auth;
use App\Models\LetterReceiver;
use App\Models\User;
use App\Models\Letter;

class InboxController extends Controller
{
    public function index() {
        return view("inbox.index");
    }

    public function tableInbox() {
        if (request()->ajax()) {

            $letters = DB::table('letters')
            ->join('letter_receivers', 'letter_receivers.letter_id', '=', 'letters.id')
            ->join('letter_statuses', 'letter_receivers.id', '=', 'letter_statuses.letter_receiver_id')
            ->join('users', 'letters.user_id', '=', 'users.id')
            ->where('letter_statuses.status', '=', 'sented')
            ->where('letter_receivers.user_id', '=', Auth::user()->id)
            ->orWhere('letter_statuses.status', '=', 'received')
            ->orderBy('letters.id', 'DESC')
            ->get();

            // dd($query);
            
            return DataTables::of($letters)
            ->addColumn('action', function ($action) {
                $detail = '
                <li>
                    <div class="btn-detail">
                        <a href="/inbox/detail/'. $action->letter_id .'" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
                    </div>
                </li>
                <li>
                    <div class="btn-detail">
                        <a href="/disposition/'. $action->letter_id .'" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Disposisi</a>
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
        $letterReceiver = LetterReceiver::where('user_id', Auth::user()->id)->first();
        $users = User::select('id', 'name')->get();
        return view('inbox.detail', compact(['users', 'letter', 'letterReceiver']));
    }

    public function disposition(LetterReceiver $letterReceiver, Request $request){ 
        $users = User::select('id', 'name')->get();
        $letterReceiver->update([
            'disposition_id' => $request->disposition_id,
        ]);
        return redirect()->back()->with('success', 'disposisi berhasil')->with(compact('users', 'letterReceiver'));   
    }
}
