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
use App\Models\ModelHasRole;
use App\Models\Role;
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
        // TO DO : TENDIK DAN FILTER USER YANG MEMILIKI ROLE TERTENTU
        $users = User::where('id', '!=', Auth::user()->id)->with('roles')->get();

        $signed = ModelHasRole::where('unit_id', Auth::user()->units->first()->id)->get();

        return view('sent-letter.create', compact(['letterCategories', 'users', 'signed']));
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
        ]);

        $file = $request->file('file');
        $filename = time() . "_" . $file->getClientOriginalName();
        $file->storeAs('letter', $filename, 'public');
        $signed = explode('-', $request->signed);

        $letter = Letter::create([
            "user_id" => Auth::user()->id,
            "signed_id" => $signed[0],
            "letter_category_id" => $request->letter_category_id,
            "role_id" => $signed[1],
            "unit_id" => $signed[2],
            "title" => $request->title,
            "date" => $request->date,
            "file" => $filename,
        ]);

        $letterStatus = Auth::user()->id == $signed[0] ? $this->constants->letter_status[1] : $this->constants->letter_status[0];

        foreach ($request->receivers as $receiver) {
            $receiver = explode('-', $receiver);

            $sentLetter = LetterReceiver::create([
                'user_id' => $receiver[0],
                'role_id' => $receiver[1],
                'unit_id' => $receiver[2],
                'letter_id' => $letter->id,
            ]);

            LetterStatus::create([
                'letter_receiver_id' => $sentLetter->id,
                'status' => $letterStatus
            ]);

            LetterHistory::create([
                'letter_receiver_id' => $sentLetter->id,
                'note' => 'Surat berhasil dikirim ke ' . $sentLetter->user->name . '',
                'status' => $letterStatus
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
                ->with(['user', 'role', 'unit']);

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
                    return $letter->role->name . " " . $letter->unit->name;
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
