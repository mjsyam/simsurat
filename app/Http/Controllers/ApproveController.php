<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Auth;

use App\Models\Letter;
use App\Models\LetterHistory;

class ApproveController extends Controller
{
    public function index() {
        return view("approve-letter.index");
    }

    public function approveLetter(Request $request) {
        LetterHistory::create([
            "letter_id" => $request->letter_id,
            "note" => "Telah disetujui oleh " . Auth::user()->name,
            "approver_id" => Auth::user()->id,
        ]);

        $histories = LetterHistory::where("letter_id", $request->letter_id)->count();
        if ($histories >= 2) {
            foreach (Letter::whereId($request->letter_id)->first()->letterReceivers as $receiver) {
                LetterStatus::where("letter_receiver_id", $receiver->id)->update([
                    "status" => "sented"
                ]);
            };
        }

        return back();
    }

    public function tableApprove() {
        if (request()->ajax()) {

            $approver = Auth::user();

            $letters = Letter::doesntHave('letterHistories', 'or', function ($query) use ($approver) {
                $query->where("approver_id", $approver->id);
            })->where(function ($query) use ($approver) {
                $query->whereHas('user.userRoles', function ($query) use ($approver) {
                    $query->where('parent_id', $approver->userRoles->first()->id)->take(1);
                })
                ->orWhereHas('letterReceivers.user.userRoles', function ($query) use ($approver) {
                    $query->where('parent_id', $approver->userRoles->first()->id)->take(1);
                });
            });

            return DataTables::of($letters)
            ->addColumn('action', function ($action) {
                $detail = '
                <li>
                    <div class="btn-detail" id="btn-'. $action->id . '">
                        <a href="" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
                    </div>
                </li>
                ';
                $approve = '
                <li>
                    <div class="btn-detail" id="btn-'. $action->id . '">
                        <form action="' . route("approve.approveLetter") . '" method="post">
                            <input type="hidden" name="_token" value="'. csrf_token() .'" />
                            <input type="hidden" name="letter_id" value="'. $action->id .'" />
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
                '.$detail.'
                '.$approve.'
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
