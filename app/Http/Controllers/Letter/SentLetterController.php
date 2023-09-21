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
use App\Models\LetterHistory;
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

    public function index()
    {
        return view('sent-letter.index');
    }

    public function create()
    {
        $letterCategories = LetterCategory::get();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('sent-letter.create', compact(['letterCategories', 'users']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'letter_category_id' => 'required',
            'title' => 'required',
            'date' => 'required',
            'signed' => 'required',
            'file' => 'required',
            'receivers' => 'required',
            'role_id' => 'required'
        ]);

        $file = $request->file('file');
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->storeAs('letter', $filename, 'public');

        $letter = Letter::create([
            "user_id" => Auth::user()->id,
            "signed_id" => $request->signed,
            "letter_category_id" => $request->letter_category_id,
            "role_id" => $request->role_id,
            "title" => $request->title,
            "date" => $request->date,
            "file" => $filename,
        ]);

        foreach ($request->receivers as $receiver) {
            $sentLetter = LetterReceiver::create([
                'user_id' => $receiver,
                'role_id' => "1", // TO DO
                'letter_id' => $letter->id,
            ]);

            LetterStatus::create([
                'letter_receiver_id' => $sentLetter->id,
                'status' => $this->constants->letter_status[1]
            ]);

            LetterHistory::create([
                'letter_receiver_id' => $sentLetter->id,
                'note' => 'Surat berhasil dikirim ke ' . $sentLetter->user->name . '',
                'status' => $this->constants->letter_status[1]
            ]);
        }

        return back()->with('success', 'Berhasil mengirim surat');
    }

    public function sentLetterTable(Request $request)
    {
        if (request()->ajax()) {
            $userRoleId = Auth::user()->roles->pluck('id');
            $letters = Letter::where(function ($query) use ($userRoleId) {
                $query->where('user_id', Auth::user()->id)
                    ->orWhereIn('role_id', $userRoleId);
            })->orderBy('created_at', 'desc')->with('LetterCategory');

            return DataTables::of($letters)
                ->addColumn('action', function ($letter) {
                    $id = $letter->id;
                    $fileLink = asset("/storage/letter/$letter->file");
                    return view('sent-letter.components.menu', compact([
                        'id', 'fileLink'
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

    public function sentLetterTableDetail(Request $request)
    {
        if (request()->ajax()) {
            $letter = LetterReceiver::where("letter_id", $request->id)
                ->with(['user', 'role']);

            return DataTables::of($letter)
                ->addColumn('action', function ($letter) {
                    return view('sent-letter.components.menu-detail', compact([
                        'letter'
                    ]));
                })
                ->addColumn('name', function ($letter) {
                    return $letter->user->name;
                }) // TO DO
                // ->addColumn('role', function ($letter) {
                //     return $letter->role->role;
                // })
                // ->addColumn('identifier', function ($letter) {
                //     return $letter->identifiers->name;
                // })
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

    public function sentReceiver($id)
    {
        $receiver = LetterReceiver::with([
            'user',
            'letter',
            'letterStatus' => function ($query) {
                $query->with([
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
