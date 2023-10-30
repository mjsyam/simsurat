<?php

namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\Letter;
use App\Models\LetterHistory;

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

            $letters = Letter::where("signed_id", $user->id)->whereHas('letterReceivers', function($query){
                return $query->whereHas('letterHistories', function($query){
                    return $query->where('status', 'waiting');
                });
            })->with("letterReceivers.letterHistories");

            return DataTables::of($letters)
                ->addColumn('action', function ($letter) {
                    return view('approve-letter.action-component', compact([
                        'letter'
                    ]));
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

    public function approve(Request $request, $id)
    {
        $letter = Letter::find($id);

        foreach ($letter->letterReceivers as $letterReceiver) {
            $letterReceiver->letterStatus()->update([
                "status" => $request->action,
            ]);

            if ($request->action == "approved") {
                $letterReceiver->letterHistories()->create([
                    "letter_receiver_id" => $letterReceiver->id,
                    "note" => "Surat berhasil disetujui",
                    "status" => $request->action,
                ]);

                $letterReceiver->letterHistories()->create([
                    "letter_receiver_id" => $letterReceiver->id,
                    "note" => "Surat berhasil dikirim",
                    "status" => "sented",
                ]);

                $letterReceiver->letterStatus()->update([
                    "status" => "sented",
                ]);
            } else {
                $letterReceiver->letterHistories()->create([
                    "letter_receiver_id" => $letterReceiver->id,
                    "note" => "Surat berhasil ditolak",
                    "status" => $request->action,
                ]);
            }
        }


        return redirect()->route("approve.letter.index")->with("success", "Berhasil menyetujui surat");
    }
}
