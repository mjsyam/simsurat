<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
// use App\Http\Middleware\Role;
use App\Http\Controllers\HomeController;
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
Route::get('/test', [SentLetterController::class, 'create']);
Route::post('/test', [SentLetterController::class, 'store']);

Auth::routes();

Route::group(['middleware'=>['auth', 'role:admin']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// contoh menggunaan middleware untuk filter berdasarkan role
// Route::group(['middleware'=>['auth', 'Role:admin']], function () {
//      Route yang ingin diakses
// });
// Route::resource('admin', [AdminController::class, 'index']);
