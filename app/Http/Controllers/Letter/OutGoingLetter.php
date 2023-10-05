<?php
namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\Letter;

class OutGoingLetter extends Controller
{
    public function index()
    {
        return view("outgoing-letter.index");
    }

    public function tableApprove()
    {
        if (request()->ajax()) {
            $roleIds = Auth::user()->roles->first()->children->pluck("id");

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
