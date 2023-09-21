<?php

namespace App\Http\Controllers\Letter;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Letter;
use App\Models\LetterHistory;
use App\Models\LetterReceiver;
use App\Models\User;
use App\Utils\ErrorHandler;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReceivedLetterController extends Controller
{
    //
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }

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
        $letter = Letter::with([ 'letterCategory', 'signed'])->findOrFail($id);
        $letterReceiver = LetterReceiver::with('letterHistories')->where('user_id', Auth::user()->id)->first();
        $isRead = LetterHistory::where('letter_receiver_id', $letterReceiver->id)->where('status', $this->constants->letter_status[2])->first();
        if (!$isRead) {
            LetterHistory::create([
                'letter_receiver_id' => $letterReceiver->id,
                'note' => 'Surat telah dibaca oleh ' . Auth::user()->name . ' pada ' . Carbon::now()->format('Y-m-d H:i:s'),
                'status' => $this->constants->letter_status[2],
            ]);
            $letterReceiver->letterStatus()->update([
                'status' => $this->constants->letter_status[2],
                'read' => 1,
            ]);
        }
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
