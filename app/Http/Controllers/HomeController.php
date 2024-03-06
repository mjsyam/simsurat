<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterReceiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    //     // $this->middleware('auth');
    //     // dd(Auth::user());
    //     // if(Auth::user()->p == Hash::make('123456789')){
    //     //     return redirect()->route('change password');
    //     // }
    // }

    public function newPassword(){
        return view('auth.passwords.new-password');
    }

    public function changePassword(Request $request){
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => "required|min:8"
        ]);

        if(Hash::check($request->password, Auth::user()->password)){
            return redirect()->back()->withErrors('Password tidak boleh sama dengan password sebelumnya!');
        }else{
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Hash::check("123456789", Auth::user()->password)){
            return redirect()->route('new.password');
        }
        
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
