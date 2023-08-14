<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use Auth;

class InboxController extends Controller
{
    public function index() {
        return view("inbox.index");
    }

    public function tableInbox() {
        if (request()->ajax()) {
            $query = DB::table('letters')
            ->join('letter_receivers', 'letter_receivers.letter_id', '=', 'letters.id')
            ->join('letter_statuses', 'letter_receivers.id', '=', 'letter_statuses.letter_receiver_id')
            ->join('users', 'letters.user_id', '=', 'users.id')
            ->where('letter_statuses.status', '=', 'sented')
            ->where('letter_receivers.user_id', '=', Auth::user()->id)
            ->orWhere('letter_statuses.status', '=', 'received')
            ->orderBy('letters.id', 'DESC')
            ->get();
            return DataTables::of($query)
            ->addColumn('action', function ($action) {
                $detail = '
                <li>
                    <div class="btn-detail" id="btn-'. $action->id . '">
                        <a href="" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
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
}
