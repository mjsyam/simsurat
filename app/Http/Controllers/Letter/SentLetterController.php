<?php

namespace App\Http\Controllers\Letter;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\Identifier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

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
        $user = Auth::user();

        if ($user->status !== $this->constants->user_status[2]) {
            abort(403, 'Anda tidak berhak membuat surat');
        }

        $letterCategories = LetterCategory::get();

        // $users = User::where('id', '!=', Auth::user()->id)->with([
        //     'identifiers.role',
        //     'identifiers.unit'
        // ])->get();

        // $signed = User::whereHas('identifiers', function ($query) {
        //     $query->where('unit_id', Auth::user()->unit_id);
        // })->with([
        //     'identifiers.role',
        //     'identifiers.unit'
        // ])->get();

        $receivers = Identifier::with([
            'users',
            'role',
            'unit'
        ])->get();

        $signed = Identifier::where('unit_id', Auth::user()->unit_id)->with([
            'users',
            'role',
            'unit'
        ])->get();

        return view('sent-letter.create', compact([
            'letterCategories', 'receivers', 'signed'
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'letter_category_id' => 'required',
            'title' => 'required',
            'date' => 'required',
            'signed' => 'required',
            'file' => 'required|max:2048',
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
            "identifier_id" => $signed[1],
            "title" => $request->title,
            "date" => $request->date,
            "file" => $filename,
        ]);

        $letterStatus = Auth::user()->id == $signed[0] ? $this->constants->letter_status[1] : $this->constants->letter_status[0];

        foreach ($request->receivers as $receiver) {
            $receiver = explode('-', $receiver);

            $sentLetter = LetterReceiver::create([
                'user_id' => $receiver[0],
                'identifier_id' => $receiver[1],
                'letter_id' => $letter->id,
            ]);

            LetterStatus::create([
                'letter_receiver_id' => $sentLetter->id,
                'status' => $letterStatus
            ]);

            LetterHistory::create([
                'letter_receiver_id' => $sentLetter->id,
                // 'note' => 'Surat berhasil dikirim ke ' . $sentLetter->user->name . '',
                'note' => 'Surat mengunggu persetujuan yang bertanda tangan.',
                'status' => $letterStatus
            ]);
        }

        return redirect(route('sent.letter-index'))->with('success', 'Berhasil mengirim surat');
    }

    public function sentLetterTable(Request $request)
    {
        if (request()->ajax()) {
            $identiferIds = Auth::user()->identifiers->pluck('id');
            $letters = Letter::where(function ($query) use ($identiferIds) {
                $query->where('user_id', Auth::user()->id)
                    ->orWhereIn('identifier_id', $identiferIds);
            })->orderBy('created_at', 'desc')->with('LetterCategory');

            return DataTables::of($letters)
                ->addColumn('action', function ($letter) {
                    $id = $letter->id;
                    $fileLink = asset("/storage/letter/$letter->file");
                    return view('sent-letter.components.menu', compact([
                        'id', 'fileLink'
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

    public function sentLetterTableDetail(Request $request)
    {
        if (request()->ajax()) {
            $letter = LetterReceiver::where("letter_id", $request->id)
                ->with([
                    'user',
                    'identifier.role',
                    'identifier.unit'
                ]);

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
                    return $letter->identifier->role->name . " " . $letter->identifier->unit->name;
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
