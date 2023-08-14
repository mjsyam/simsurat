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
            'letterReceivers' => function ($query) {
                $query->where('user_id', Auth::user()->id)->with([
                    'letterStatuses'=> function ($query) {
                        $query->orderBy('created_at', 'desc')->first();
                    }]);
            }, 'user'
        ])->whereHas(
            'letterReceivers',
            function ($query) {
                $query->where('user_id', Auth::user()->id);
            }
        )->get();
        dd($letters);
        return view('status-letter.index', compact(['letters']));
    }
}
