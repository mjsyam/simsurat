<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
// use App\Http\Middleware\Role;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\Letter\SentLetterController;
use App\Http\Controllers\Letter\ReceivedLetterController;

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
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::get('/inbox/table', [InboxController::class, 'tableInbox'])->name('inbox.tableInbox');
    Route::get('/inbox/detail/{letter}', [InboxController::class, 'detail'])->name('inbox.detail');
    Route::post('/inbox/disposition/{letterReceiver}', [InboxController::class, 'disposition'])->name('inbox.disposition');
    Route::get('/approve', [ApproveController::class, 'index'])->name('approve.index');
    Route::get('/approve/table', [ApproveController::class, 'tableApprove'])->name('approve.tableApprove');
    Route::post('/approve', [ApproveController::class, 'approveLetter'])->name('approve.approveLetter');
});

Route::prefix('admin')->group(function () {
    Route::controller(Admin\UserController::class)->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/list', 'index')->name('admin.user.index');
            Route::get('/detail/{id}', 'show')->name('admin.user.detail');
            Route::delete('/update/{id}', 'update')->name('admin.user.update');
            Route::delete('/delete/{id}', 'destroy')->name('admin.user.delete');
            Route::post('/add', 'store')->name('admin.user.add');

            Route::get('/get-data/table', 'getUsersTable')->name('admin.user.table');
        });
    });

    Route::controller(Admin\RoleController::class)->group(function () {
        Route::prefix('role')->group(function () {
            Route::get('/list', 'index')->name('admin.role.index');
            Route::get('/detail/{id}', 'show')->name('admin.role.detail');
            Route::delete('/update/{id}', 'update')->name('admin.role.update');
            Route::delete('/delete/{id}', 'destroy')->name('admin.role.delete');
            Route::post('/add', 'store')->name('admin.role.add');
            Route::post('/assign-user/{id}', 'assignUser')->name('admin.role.assignUser');
            Route::post('/remove-user/{id}', 'removeUser')->name('admin.role.removeUser');

            Route::get('/get-data/table', 'getRolesTable')->name('admin.role.table');
        });
    });
});

Route::group(['middleware'=>['auth']], function () {
    Route::get('/letter/sent', [SentLetterController::class, 'index'])->name('sent.letter-index');
    Route::get('/letter/sent/detail/{id}', [SentLetterController::class, 'show'])->name('sent.letter-detail');
    Route::get('/letter/sent/detail/{id}/pdf', [SentLetterController::class, 'exportPdf'])->name('sent.letter-exports');

    Route::get('/letter/sent/table', [SentLetterController::class, 'sentLetterTable'])->name('sent.letter-table');
    Route::get('/letter/sent/create', [SentLetterController::class, 'create'])->name('sent.letter-create');
    Route::post('/letter/sent/create', [SentLetterController::class, 'store'])->name('sent.letter-store');
    Route::get('/letter/sent/{id}', [SentLetterController::class, 'show'])->name('sent.letter-show');
    Route::get('/letter/sent/{id}/receiver/{receiver_id}', [SentLetterController::class, 'sentReceiver'])->name('sent.receiver.show');

    Route::get('/letter/received', [ReceivedLetterController::class, 'index'])->name('received.letter-index');
    Route::get('/letter/received/table', [ReceivedLetterController::class, 'receivedLetterTable'])->name('received.letter-table');
    Route::get('/letter/received/{id}', [ReceivedLetterController::class, 'show'])->name('received.letter-show');
});

// contoh menggunaan middleware untuk filter berdasarkan role
// Route::group(['middleware'=>['auth', 'Role:admin']], function () {
//      Route yang ingin diakses
// });
// Route::resource('admin', [AdminController::class, 'index']);
