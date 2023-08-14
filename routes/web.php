<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
// use App\Http\Middleware\Role;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\Letter\SentLetterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::group(['middleware'=>['auth']], function () {
    Route::get('/approve', [ApproveController::class, 'index'])->name('approve.index');
    Route::get('/approve/table', [ApproveController::class, 'tableApprove'])->name('approve.tableApprove');
    Route::post('/approve', [ApproveController::class, 'approveLetter'])->name('approve.approveLetter');
});

Route::group(['middleware'=>['auth']], function () {
    Route::get('/letter/sent', [SentLetterController::class, 'index'])->name('sent.letter-index');
    Route::get('/letter/sent/detail/{id}', [SentLetterController::class, 'show'])->name('sent.letter-detail');
    Route::get('/letter/sent/detail/{id}/pdf', [SentLetterController::class, 'exportPdf'])->name('sent.letter-exports');

    Route::get('/letter/sent/table', [SentLetterController::class, 'sentLetterTable'])->name('sent.letter-table');
    Route::get('/letter/sent/create', [SentLetterController::class, 'create'])->name('sent.letter-create');
    Route::post('/letter/sent/create', [SentLetterController::class, 'store'])->name('sent.letter-store');
});

// contoh menggunaan middleware untuk filter berdasarkan role
// Route::group(['middleware'=>['auth', 'Role:admin']], function () {
//      Route yang ingin diakses
// });
// Route::resource('admin', [AdminController::class, 'index']);
