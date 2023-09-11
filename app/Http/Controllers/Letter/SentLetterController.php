<?php

namespace App\Http\Controllers\Letter;

use App\Constants;
use App\Exceptions\AuthorizationError;
use App\Exceptions\NotFoundError;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\User;
use App\Models\Letter;
use App\Models\LetterCategory;
use App\Models\LetterReceiver;
use App\Models\LetterStatus;
use App\Utils\ErrorHandler;

class SentLetterController extends Controller
{
    private $errorHandler;
    private $constants;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();
        $this->constants = new Constants();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sent-letter.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $letterCategories = LetterCategory::get();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('sent-letter.create', compact(['letterCategories', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'letter_category_id' => 'required',
            'title' => 'required',
            'date' => 'required',
            'refrences_number' => 'required',
            'letter_destination' => 'required|nullable',
            'body' => 'required',
            'sender' => 'required|nullable',
            'receivers' => 'required'
        ]);

        $user = Auth::user();
        $userRole = $user->userRoles->first()->id;
        $identifiers = $user->identifiers->first()->id;

        $letter = Letter::create([
            'user_id' => Auth::user()->id,
            'letter_category_id' => $request->letter_category_id,
            'date' => $request->date,
            'title' => $request->title,
            'date' => $request->date,
            'refrences_number' => $request->refrences_number,
            'letter_destination' => $request->letter_destination,
            'body' => $request->body,
            'sender' => $request->sender,
            'role_id' => $userRole,
            'identifier_id' => $identifiers,
        ]);
        foreach ($request->receivers as $receiver) {
            $data = User::whereId($receiver)->first();
            $role = $data->userRoles->first()->id;
            $identifier = $data->identifiers->first()->id;

            $letterReciver = LetterReceiver::create([
                'user_id' => $receiver,
                'role_id' => $role,
                'letter_id' => $letter->id,
                'identifier_id' => $identifier,
            ]);

            LetterStatus::create([
                'letter_receiver_id' => $letterReciver->id,
                'status' => $this->constants->letter_status[1]
            ]);
        }

        return back()->with('success', 'Berhasil mengirim surat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $letter = Letter::findOrFail($id);

        return view('sent-letter.detail', compact(['letter']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function sentLetterTable(Request $request)
    {
        if (request()->ajax()) {
            $userRoleId = Auth::user()->userRoles->first()->id;
            $letters = Letter::where(function ($query) use ($userRoleId) {
                $query->where('user_id', Auth::user()->id)
                    ->orWhere('role_id', $userRoleId);
            })->orderBy('created_at', 'desc')->with('LetterCategory');

            return DataTables::of($letters)
                ->addColumn('action', function ($letter) {
                    $detail = '
                <li>
                    <div class="btn-detail">
                        <a href="' . route('sent.letter-detail', ['id' => $letter->id]) . '" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
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

    public function exportPdf(string $id)
    {
        // try {
            $userId = Auth::user()->id;
            $letter = Letter::whereId($id)->first();

            if (!$letter) {
                throw new NotFoundError("Letter tidak ditemukan");
            }

            // if ($letter->user_id != $userId) {
            //     throw new AuthorizationError("Anda tidak berhak mengakses surat ini");
            // }

            // return view('letterPdf', compact(['letter']));

            $pdf = Pdf::loadView('letterPdf', compact(['letter']));
            return $pdf->download('sample.pdf');
        // } catch (\Throwable $th) {
        //     $data = $this->errorHandler->handle($th);

        //     return response()->json($data["data"], $data["code"]);
        // }
    }

    public function sentReceiver($id, $receiver_id)
    {
        $receiver = LetterReceiver::with([
            'user',
            'letter',
            'letterStatus' => function ($query) {
                $query->with([
                    'approver'
                ])->orderBy('id', 'desc');
            },
            'letterHistories' => function ($query) {
                $query->with([
                    'approver'
                ])->orderBy('id', 'desc');
            },
        ])->find($receiver_id);
        return view('sent-letter.receiver.index', compact(['receiver']));
    }
}
