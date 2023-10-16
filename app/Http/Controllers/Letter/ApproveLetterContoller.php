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

            $letters = Letter::where("signed_id", $user->id)->whereHas('letterReceivers', function($query){
                return $query->whereHas('letterHistories', function($query){
                    return $query->where('status', 'waiting');
                });
            })->get();

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

    public function detail($id)
    {
        $letter = Letter::find($id);

        return view("approve-letter.detail", compact("letter"));
    }

    public function approve($id)
    {
        $letter = Letter::find($id);

        $letter->update([
            "status" => "approved"
        ]);

        return redirect()->route("approve.letter.index")->with("success", "Berhasil menyetujui surat");
    }
}
