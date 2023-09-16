<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\Letter;
use App\Models\LetterHistory;
use App\Models\LetterStatus;

class ApproveController extends Controller
{
    public function index()
    {
        return view("approve-letter.index");
    }

    public function tableApprove()
    {
        if (request()->ajax()) {
            $roleIds = Auth::user()->userRoles->first()->children->pluck("id");

            $letters = Letter::where(function ($query) use ($roleIds) {
                $query->where(function ($subQuery) use ($roleIds) {
                    $subQuery->whereHas('role', function ($roleSubQuery) use ($roleIds) {
                        $roleSubQuery->whereIn('roles.id', $roleIds);
                    })->orWhereHas('letterReceivers', function ($receiverSubQuery) use ($roleIds) {
                        $receiverSubQuery->whereIn('letter_receivers.role_id', $roleIds);
                    });
                });
            })->get();

            return DataTables::of($letters)
                ->addColumn('action', function ($action) {
                    return '<div class="btn-detail" id="btn-' . $action->id . '">
                    <a href="' . route('pdf.letter', ['letter' => $action->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
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
