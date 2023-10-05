<?php

namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\Letter;

class ApproveLetterContoller extends Controller
{
    public function index()
    {
        return view("approve-letter.index");
    }

    public function tableApprove()
    {
        if (request()->ajax()) {
            $user = Auth::user();

            $letters = Letter::where("signed_id", $user->id)->where("user_id", "!=", $user->id)->get();

            return DataTables::of($letters)
                ->addColumn('action', function ($letter) {
                    return '<div class="btn-detail" id="btn-' . $letter->id . '">
                    <a href="' . asset("/storage/letter/$letter->file") . '" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
                </div>';
                })
                ->addColumn('name', function ($action) {
                    return $action->user->name;
                })
                ->addColumn('email', function ($action) {
                    return $action->user->email;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
