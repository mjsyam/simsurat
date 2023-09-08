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

    public function approveLetter(Request $request)
    {
        $letter = Letter::whereId($request->letter_id)->first();
        $roleIds = Auth::user()->userRoles->first()->children->pluck("id")->toArray();
        $identifierId = Auth::user()->identifiers->first()->children->pluck("id")->toArray();
        $letterRoleId = $letter->role_id;
        $letterIdentifierId = $letter->identifier_id;

        foreach ($letter->letterReceivers as $receiver) {
            if (in_array($letterRoleId, $roleIds) && in_array($letterIdentifierId, $identifierId)) {
                LetterHistory::create([
                    "letter_receiver_id" => $receiver->id,
                    "note" => "Telah disetujui oleh " . Auth::user()->name,
                    "status" => "waiting",
                    "approver_id" => Auth::user()->id,
                ]);
            }
            if (in_array($receiver->role_id, $roleIds) && in_array($receiver->identifier_id, $identifierId)) {
                LetterHistory::create([
                    "letter_receiver_id" => $receiver->id,
                    "note" => "Telah disetujui oleh " . Auth::user()->name,
                    "status" => "waiting",
                    "approver_id" => Auth::user()->id,
                ]);
            }

            if ($receiver->letterHistories->count() >= 2) {
                LetterHistory::create([
                    "letter_receiver_id" => $receiver->id,
                    "note" => "Telah disetujui oleh semua atasan",
                    "status" => "sented",
                ]);
            }
        };

        return back();
    }

    public function tableApprove()
    {
        if (request()->ajax()) {
            $roleIds = Auth::user()->userRoles->first()->children->pluck("id");
            $identifierId = Auth::user()->identifiers->first()->children->pluck("id");

            $letters = Letter::where(function ($query) use ($roleIds, $identifierId) {
                $query->where(function ($subQuery) use ($roleIds) {
                    $subQuery->whereHas('role', function ($roleSubQuery) use ($roleIds) {
                        $roleSubQuery->whereIn('roles.id', $roleIds);
                    })->orWhereHas('letterReceivers', function ($receiverSubQuery) use ($roleIds) {
                        $receiverSubQuery->whereIn('letter_receivers.role_id', $roleIds);
                    });
                })->where(function ($subQuery) use ($identifierId) {
                    $subQuery->whereHas('identifiers', function ($identifierSubQuery) use ($identifierId) {
                        $identifierSubQuery->whereIn('identifiers.id', $identifierId);
                    })->orWhereHas('letterReceivers', function ($receiverSubQuery) use ($identifierId) {
                        $receiverSubQuery->whereIn('letter_receivers.identifier_id', $identifierId);
                    });
                });
            })->get();

            return DataTables::of($letters)
                ->addColumn('action', function ($action) {
                    $detail = '
                <li>
                    <div class="btn-detail" id="btn-' . $action->id . '">
                        <a href="" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
                    </div>
                </li>
                ';
                    $approve = '
                <li>
                    <div class="btn-detail" id="btn-' . $action->id . '">
                        <form action="' . route("approve.approveLetter") . '" method="post">
                            <input type="hidden" name="_token" value="' . csrf_token() . '" />
                            <input type="hidden" name="letter_id" value="' . $action->id . '" />
                            <button class="btn">
                            <i class="fa-solid fa-check me-3"></i> Approve
                            </button>
                        </form>
                    </div>
                </li>
                ';
                    return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                ' . $detail . '
                ' . $approve . '
                </ul>
                ';
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
