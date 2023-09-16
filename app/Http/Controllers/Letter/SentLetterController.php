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
use App\Models\UserRole;
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
            'institution' => 'required',
            'signed' => 'required',
            'role_id' => 'required',
            'receivers' => 'required'
        ]);

        $letter = Letter::create([
            'user_id' => Auth::user()->id,
            'letter_category_id' => $request->letter_category_id,
            'date' => $request->date,
            'title' => $request->title,
            'date' => $request->date,
            'refrences_number' => $request->refrences_number,
            'letter_destination' => $request->letter_destination,
            'institution' => $request->institution,
            'body' => $request->body,
            'signed' => $request->signed,
            'role_id' => $request->role_id,
        ]);

        foreach ($request->receivers as $receiver) {
            $data = User::whereId($receiver)->first();
            $role = $data->roles->first()->id;

            $sentLetter = LetterReceiver::create([
                'user_id' => $receiver,
                'role_id' => $role,
                'letter_id' => $letter->id,
            ]);

            LetterStatus::create([
                'letter_receiver_id' => $sentLetter->id,
                'status' => $this->constants->letter_status[1]
            ]);
        }

        return back()->with('success', 'Berhasil mengirim surat');
    }

    /**
     * Display the specified resource.
     */
    public function sentLetterTableDetail(Request $request)
    {
        if (request()->ajax()) {
            $letter = LetterReceiver::where("letter_id", $request->id)
                ->with(['user', 'role', 'identifiers']);

            return DataTables::of($letter)
                ->addColumn('action', function ($letter) {
                    return view('sent-letter.components.menu-detail', compact([
                        'letter'
                    ]));
                })
                ->addColumn('name', function ($letter) {
                    return $letter->user->name;
                })
                ->addColumn('role', function ($letter) {
                    return $letter->role->role;
                })
                ->addColumn('identifier', function ($letter) {
                    return $letter->identifiers->name;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
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
            $userRoleId = Auth::user()->roles->first()->id;
            $letters = Letter::where(function ($query) use ($userRoleId) {
                $query->where('user_id', Auth::user()->id)
                    ->orWhere('role_id', $userRoleId);
            })->orderBy('created_at', 'desc')->with('LetterCategory');

            return DataTables::of($letters)
                ->addColumn('action', function ($letter) {
                    $id = $letter->id;
                    return view('sent-letter.components.menu', compact([
                        'id'
                    ]));
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

            return view('letterPdf', compact(['letter']));

            $pdf = Pdf::loadView('letterPdf', compact(['letter']));
            return $pdf->download('sample.pdf');
        // } catch (\Throwable $th) {
        //     $data = $this->errorHandler->handle($th);

        //     return response()->json($data["data"], $data["code"]);
        // }
    }

    public function sentReceiver($id)
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
        ])->findOrFail($id);
        return view('sent-letter.receiver.index', compact(['receiver']));
    }
}
