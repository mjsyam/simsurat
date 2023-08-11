<?php

namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Letter;
use App\Models\LetterReceiver;
use Illuminate\Http\Request;

class SentLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $letters = Letter::where('user_id', Auth::user()->id)->with('letterReceivers.LetterStatus')->orderBy('created_at', 'desc');

        return view('', compact(['letters']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('test1');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json("dwada");

        $request->validate([
            'letter_category_id' => 'required',
            'title' => 'required',
            'refrences_number' => 'required',
            'letter_destination' => 'required',
            'body' => 'required',
            'sender' => 'required',
            'receivers' => 'required'
        ]);

        DB::transaction(function () use ($request) {
            try {
                $letter = Letter::create([
                    'user_id' => Auth::user()->id,
                    'letter_category_id' => $request->letter_category_id,
                    'title' => $request->title,
                    'refrences_number' => $request->refrences_number,
                    'letter_destination' => $request->letter_destination,
                    'body' => $request->body,
                    'sender' => $request->sender,
                ]);

                collect($request->receiver)->map(function ($receiver) use ($letter) {
                    $role = User::whereId($receiver->user_id)->first()->role;

                    LetterReceiver::create([
                        'user_id' => $receiver->user_id,
                        'role_id' => $role,
                        'letter_id' => $letter->id
                    ]);
                });

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return response()->json("11");
            }
        });
        return response()->json("dwada");
        // return back()->with('success', 'Berhasil mengirim surat');
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
}
