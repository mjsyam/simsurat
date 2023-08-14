<?php

namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Letter;
use App\Models\LetterCategory;
use App\Models\LetterReceiver;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SentLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::user()->id;

        return view('sent-letter.index', compact(['userId']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $letterCategories = LetterCategory::get();
        $users = User::get();
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
            'refrences_number' => 'required',
            'letter_destination' => 'required|nullable',
            'body' => 'required',
            'sender' => 'required|nullable',
            'receivers' => 'required'
        ]);

        $userRole = User::whereId(Auth::user()->id)->first()->userRoles->first()->id;

        $letter = Letter::create([
            'user_id' => Auth::user()->id,
            'letter_category_id' => $request->letter_category_id,
            'title' => $request->title,
            'refrences_number' => $request->refrences_number,
            'letter_destination' => $request->letter_destination,
            'body' => $request->body,
            'sender' => $request->sender,
            'role_id'=> $userRole
        ]);
        foreach ($request->receivers as $receiver) {
            $role = User::whereId($receiver)->first()->userRoles->first()->id;

            LetterReceiver::create([
                'user_id' => $receiver,
                'role_id' => $role,
                'letter_id' => $letter->id
            ]);
        }


        // DB::transaction(function () use ($request) {
        //     try {
        //         $letter = Letter::create([
        //             'user_id' => Auth::user()->id,
        //             'letter_category_id' => $request->letter_category_id,
        //             'title' => $request->title,
        //             'refrences_number' => $request->refrences_number,
        //             'letter_destination' => $request->letter_destination,
        //             'body' => $request->body,
        //             'sender' => $request->sender,
        //         ]);

        //         foreach ($request->receivers as $receiver) {
        //             $role = User::whereId($receiver)->first()->role;

        //             LetterReceiver::create([
        //                 'user_id' => $receiver,
        //                 'role_id' => $role,
        //                 'letter_id' => $letter->id
        //             ]);
        //         }

        //         DB::commit();
        //     } catch (\Throwable $th) {
        //         DB::rollback();
        //         return back()->with('fail', 'Gagal mengirim surat');
        //     }
        // });

        return back()->with('success', 'Berhasil mengirim surat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function sentLetterTable(Request $request) {
        if (request()->ajax()) {
            $letters = Letter::whereId($request->userId)->orderBy('created_at', 'desc');

            return DataTables::of($letters)
            ->addColumn('action', function ($action) {
                $detail = '
                <li>
                    <div class="btn-detail" id="btn-'. $action->id . '">
                        <a href="" data-bs-toggle="modal" class="dropdown-item py-2"><i class="fa-solid fa-eye me-3"></i>Detail</a>
                    </div>
                </li>
                ';
                return '
                <button type="button" class="btn btn-secondary btn-icon btn-sm" data-kt-menu-placement="bottom-end" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="dropdown-menu">
                '.$detail.'
                </ul>
                ';
            })
            ->addColumn('category', function ($lettter) {
                return $lettter->letterCategory->name;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
