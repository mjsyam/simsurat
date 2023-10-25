<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
// use App\Http\Middleware\Role;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Letter\OutGoingLetter;
use App\Http\Controllers\Letter\ApproveLetterContoller;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\Letter\SentLetterController;
use App\Http\Controllers\Letter\ReceivedLetterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::get('/pdf/letter/{letter}', [PDFController::class, 'index'])->name('pdf.letter');

Route::group(['middleware' => ['auth']], function () {
    // TODO : input user yang didisposisi diharapkan sesuai dengan aturan top down dan down top
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::get('/inbox/table', [InboxController::class, 'tableInbox'])->name('inbox.tableInbox');
    Route::get('/inbox/detail/{letter}', [InboxController::class, 'detail'])->name('inbox.detail');
    Route::post('/inbox/disposition/{letterReceiver}', [InboxController::class, 'disposition'])->name('inbox.disposition');

    Route::get('/outgoing-letter', [OutGoingLetter::class, 'index'])->name('outgoing-letter.index');
    Route::get('/outgoing-letter/table', [OutGoingLetter::class, 'tableApprove'])->name('outgoing-letter.tableApprove');


    Route::get('/approve/letter', [ApproveLetterContoller::class, 'index'])->name('approve.letter.index');
    Route::get('/approve/letter/table', [ApproveLetterContoller::class, 'tableApprove'])->name('approve.letter.tableApprove');
    Route::post('/approve/letter/{id}', [ApproveLetterContoller::class, 'approve'])->name('approve.letter.approve');
});

Route::prefix('admin')->group(function () {
    // TODO : perbaiki detial user
    Route::controller(Admin\UserController::class)->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/list', 'index')->name('admin.user.index');
            Route::get('/detail/{id}', 'show')->name('admin.user.detail');
            Route::put('/update/{id}', 'update')->name('admin.user.update');
            Route::delete('/delete/{id}', 'destroy')->name('admin.user.delete');
            Route::post('/add', 'store')->name('admin.user.add');

            Route::get('/get-data/table', 'getUsersTable')->name('admin.user.table');
            Route::post('/assign-identifier/{id}','assignIdentifier')->name('admin.user.assignIdentifier');
        });
    });

    // TODO : role seharusnya tidak boleh dihapus, hanya boleh digantikan
    Route::controller(Admin\RoleController::class)->group(function () {
        Route::prefix('role')->group(function () {
            Route::get('/list', 'index')->name('admin.role.index');
            Route::get('/detail/{role}', 'show')->name('admin.role.detail');
            Route::put('/update/{role}', 'update')->name('admin.role.update');
            Route::delete('/delete/{role}', 'destroy')->name('admin.role.delete');
            Route::post('/add', 'store')->name('admin.role.add');
            Route::post('/assign-identifier/{role}', 'assignIdentifier')->name('admin.role.assignIdentifier');
            Route::post('/remove-identifier/{role}', 'removeIdentifier')->name('admin.role.removeIdentifier');

            Route::get('/get-data/table', 'getRolesTable')->name('admin.role.table');
        });
    });

    Route::controller(Admin\UnitController::class)->group(function () {
        Route::prefix('unit')->group(function () {
            Route::get('/list', 'index')->name('admin.unit.index');
            Route::get('/detail/{unit}', 'show')->name('admin.unit.detail');
            Route::put('/update/{unit}', 'update')->name('admin.unit.update');
            Route::delete('/delete/{unit}', 'destroy')->name('admin.unit.delete');
            Route::post('/add', 'store')->name('admin.unit.add');
            Route::post('/assign-identifier/{unit}', 'assignIdentifier')->name('admin.unit.assignIdentifier');
            Route::post('/remove-identifier/{unit}', 'removeIdentifier')->name('admin.unit.removeIdentifier');

            Route::get('/get-data/table', 'getUnitsTable')->name('admin.unit.table');
        });
    });

    Route::controller(Admin\IdentifierController::class)->group(function () {
        Route::prefix('identifier')->group(function () {
            Route::get('/list', 'index')->name('admin.identifier.index');
            Route::get('/detail/{identifier}', 'show')->name('admin.identifier.detail');
            Route::put('/update/{identifier}', 'update')->name('admin.identifier.update');
            Route::delete('/delete/{identifier}', 'destroy')->name('admin.identifier.delete');
            Route::post('/add', 'store')->name('admin.identifier.add');

            Route::get('/get-data/table', 'getIdentifiersTable')->name('admin.identifier.table');
        });
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('letter')->group(function () {

        Route::controller(SentLetterController::class)->group(function () {
            Route::prefix('sent')->group(function () {
                Route::get('/', 'index')->name('sent.letter-index');

                Route::get('/table', 'sentLetterTable')->name('sent.letter-table');
                Route::get('/table/detail', 'sentLetterTableDetail')->name('sent.letter-table-detail');

                Route::get('/create', 'create')->name('sent.letter-create');
                Route::post('/create', 'store')->name('sent.letter-store');
                Route::get('/{id}', 'show')->name('sent.letter-show');
            });

            Route::get('/receiver/{id}', 'sentReceiver')->name('sent.receiver.show');
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
            Route::get('/role', 'getUserRoleByUnit')->name('user.get-role');
        });
    });
});

// contoh menggunaan middleware untuk filter berdasarkan role
// Route::group(['middleware'=>['auth', 'Role:admin']], function () {
//      Route yang ingin diakses
// });
// Route::resource('admin', [AdminController::class, 'index']);
