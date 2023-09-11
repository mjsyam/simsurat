<?php

namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use App\Models\LetterReceiver;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class ReceivedLetterController extends Controller
{
    //
    public function index()
    {
        $letters = Letter::with([
            'letterReceivers.letterStatus' => fn ($q) => $q->orderBy('status'),
            'user',
            'letterCategory'
        ])->whereHas(
            'letterReceivers',
            function ($query) {
                $query->where('user_id', Auth::user()->id);
            }
        )->get();
        return view('received.index', compact(['letters']));
    }

    public function show(string $id)
    {
        //
        $letter = Letter::with([ 'letterCategory'])->findOrFail($id);
        $letterReceiver = LetterReceiver::where('user_id', Auth::user()->id)->first();
        $users = User::select('id', 'name')->get();

        return view('inbox.detail', compact(['users', 'letter', 'letterReceiver']));
    }

    public function receivedLetterTable(Request $request)
    {
        if (request()->ajax()) {
            $letters = Letter::with([
                'letterReceivers.letterStatus' => fn ($q) => $q->orderBy('status'),
                'user',
                'letterCategory'
            ])->whereHas(
                'letterReceivers',
                function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }
            )->get();

            return DataTables::of($letters)
                ->addColumn('action', function ($letter) {
                    $detail = '
                <li>
                    <div class="btn-detail">
                        <a href="' . route('received.letter-show', ['id' => $letter->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
                    </div>
                </li>
                ';
                    return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                ' . $detail . '
                </ul>
                ';
                })
                ->addColumn('refrences_number', function ($lettter) {
                    return $lettter->refrences_number;
                })
                ->addColumn('title', function ($lettter) {
                    return $lettter->title;
                })
                ->addColumn('category', function ($lettter) {
                    return $lettter->letterCategory->name;
                })
                ->addColumn('created_at', function ($lettter) {
                    return Carbon::parse($lettter->created_at)->format('Y-m-d H:i:s');
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
