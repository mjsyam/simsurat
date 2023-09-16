<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
// use App\Http\Middleware\Role;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\Letter\SentLetterController;
use App\Http\Controllers\Letter\ReceivedLetterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;

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

Route::get('/pdf/letter/{letter}', [PDFController::class, 'index'])->name('pdf.letter');

Route::group(['middleware'=>['auth']], function () {
    // TODO : input user yang didisposisi diharapkan sesuai dengan aturan top down dan down top
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::get('/inbox/table', [InboxController::class, 'tableInbox'])->name('inbox.tableInbox');
    Route::get('/inbox/detail/{letter}', [InboxController::class, 'detail'])->name('inbox.detail');
    Route::post('/inbox/disposition/{letterReceiver}', [InboxController::class, 'disposition'])->name('inbox.disposition');

    Route::get('/approve', [ApproveController::class, 'index'])->name('approve.index');
    Route::get('/approve/table', [ApproveController::class, 'tableApprove'])->name('approve.tableApprove');
});

Route::prefix('admin')->group(function () {
    // TODO : perbaiki detial user
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

    // TODO : role seharusnya tidak boleh dihapus, hanya boleh digantikan
    Route::controller(Admin\RoleController::class)->group(function () {
        Route::prefix('role')->group(function () {
            Route::get('/list', 'index')->name('admin.role.index');
            Route::get('/detail/{role}', 'show')->name('admin.role.detail');
            Route::delete('/update/{role}', 'update')->name('admin.role.update');
            Route::delete('/delete/{role}', 'destroy')->name('admin.role.delete');
            Route::post('/add', 'store')->name('admin.role.add');
            Route::post('/assign-user/{role}', 'assignUser')->name('admin.role.assignUser');
            Route::post('/remove-user/{role}', 'removeUser')->name('admin.role.removeUser');

            Route::get('/get-data/table', 'getRolesTable')->name('admin.role.table');
        });
    });
});

Route::group(['middleware'=>['auth']], function () {
    Route::prefix('letter')->group(function () {
        Route::prefix('sent')->group(function () {
            Route::controller(SentLetterController::class)->group(function () {
                Route::get('/', 'index')->name('sent.letter-index');
                Route::get('/detail/{id}/pdf', 'exportPdf')->name('sent.letter-exports');

                Route::get('/table', 'sentLetterTable')->name('sent.letter-table');
                Route::get('/table/detail', 'sentLetterTableDetail')->name('sent.letter-table-detail');

                Route::get('/create', 'create')->name('sent.letter-create');
                Route::post('/create', 'store')->name('sent.letter-store');
                Route::get('/{id}', 'show')->name('sent.letter-show');
                Route::get('/{id}/receiver/{receiver_id}', 'sentReceiver')->name('sent.receiver.show');
            });
        });

        Route::prefix('received')->group(function () {
            Route::controller(ReceivedLetterController::class)->group(function () {
                Route::get('/', 'index')->name('received.letter-index');
                Route::get('/table', 'receivedLetterTable')->name('received.letter-table');
                Route::get('/{id}', 'show')->name('received.letter-show');
            });
        });
    });

    Route::prefix('user')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/role', 'getUserRole')->name('user.get-role');
        });
    });
});

// contoh menggunaan middleware untuk filter berdasarkan role
// Route::group(['middleware'=>['auth', 'Role:admin']], function () {
//      Route yang ingin diakses
// });
// Route::resource('admin', [AdminController::class, 'index']);
