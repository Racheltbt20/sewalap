<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;

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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/daftarbooking', [TransactionController::class, 'index'])->name('booking.index');
    Route::get('/booking', [TransactionController::class, 'create'])->name('booking.create');
    Route::post('/booking', [TransactionController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}/bayar', [TransactionController::class, 'bayar'])->name('booking.bayar');
    Route::put('/booking/{id}', [TransactionController::class, 'update'])->name('booking.update');
    Route::get('/riwayat', [TransactionController::class, 'riwayat'])->name('riwayat.index');
});
