<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterReceiver;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // middleware juga bisa digunakan didalam controller
    // bukan hanya di route
    // jika dibutuhkan maka middleware bisa digunakan di controller
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $letter_unread = LetterReceiver::where('user_id', auth()->user()->id)
        ->with(['letter','letterStatus'])
        ->whereHas('letterStatus', function($query){
            $query->where('read', false);
        })->count();

        $letter_in = LetterReceiver::where('user_id', auth()->user()->id)->count();

        $letter_out = Letter::where('user_id', auth()->user()->id)->count();

        $letter_status_sent = LetterReceiver::where('user_id', auth()->user()->id)
        ->with(['letter','letterStatus'])
        ->whereHas('letterStatus', function($query){
            $query->where('status', 'sent');
        })->count();

        $letter_status_read = LetterReceiver::where('user_id', auth()->user()->id)
        ->with(['letter','letterStatus'])
        ->whereHas('letterStatus', function($query){
            $query->where('status', 'read');
        })->count();

        $letter_status_disposition = LetterReceiver::where('user_id', auth()->user()->id)
        ->with(['letter','letterStatus'])
        ->whereHas('letterStatus', function($query){
            $query->where('status', 'disposition');
        })->count();

        $letter_status_approved = LetterReceiver::where('user_id', auth()->user()->id)
        ->with(['letter','letterStatus'])
        ->whereHas('letterStatus', function($query){
            $query->where('status', 'approved');
        })->count();

        $letter_status_rejected = LetterReceiver::where('user_id', auth()->user()->id)
        ->with(['letter','letterStatus'])
        ->whereHas('letterStatus', function($query){
            $query->where('status', 'rejected');
        })->count();

        
        return view('home', compact([
            'letter_unread',
            'letter_in',
            'letter_out',
            'letter_status_sent',
            'letter_status_read',
            'letter_status_disposition',
            'letter_status_approved',
            'letter_status_rejected'
        ]));
    }
}
