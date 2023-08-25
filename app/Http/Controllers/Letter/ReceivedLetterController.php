<?php

namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use App\Models\LetterStatus;
use Illuminate\Support\Facades\Auth;

class ReceivedLetterController extends Controller
{
    //
    public function index()
    {
        $letters = Letter::with([
            'letterReceivers.letterStatus' => fn ($q) => $q->orderBy('status'),
            'user'
        ])->whereHas(
            'letterReceivers',
            function ($query) {
                $query->where('user_id', Auth::user()->id);
            }
        )->get();
        dd($letters);
        return view('received.index', compact(['letters']));
    }
}
