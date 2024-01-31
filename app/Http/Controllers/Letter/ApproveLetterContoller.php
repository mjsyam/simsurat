<?php

namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\Letter;
use Carbon\Carbon;

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
                    return $query->where('status', 'Menunggu Persetujuan');
                });
            })->with("letterReceivers.letterHistories")->orderBy("created_at", "desc");

            return DataTables::of($letters)
                ->addColumn('action', function ($letter) {
                    return view('approve-letter.action-component', compact([
                        'letter'
                    ]));
                })
                ->addColumn('user', function ($letter) {
                    return $letter->user->name;
                })
                ->addColumn('signed', function ($letter) {
                    return $letter->signed->name;
                })
                ->addColumn('receiver', function ($letter) {
                    $names = $letter->letterReceivers->map(function ($item) {
                        return $item->user->name;
                    })->take(2)->toArray();

                    $count = $letter->letterReceivers->count();

                    if ($count > 2) {
                        return implode(', ', $names) . " dan " . ($count - 2) . " lainnya";
                    }

                    return implode(', ', $names);
                })
                ->addColumn('category', function ($letter) {
                    return $letter->letterCategory->name;
                })
                ->addColumn('created_at', function ($letter) {
                    return Carbon::parse($letter->created_at)->format('Y-m-d H:i:s');
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
