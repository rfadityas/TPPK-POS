<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Route
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'loginauth']);
Route::get('/logout', [AuthController::class, 'logout']);

// Home Route
Route::get('/', [HomeController::class, 'index'])->middleware('auth');

// Transaksi Route
Route::middleware(['auth'])->group(function () {
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::prefix('transaksi')->group(function () {
        Route::get('/tambah', [TransaksiController::class, 'create']);
        Route::get('/store', [TransaksiController::class, 'store']);
        Route::get('/getcart', [TransaksiController::class, 'getcart']);
        Route::get('/destroy/{id}', [TransaksiController::class, 'destroy']);
        Route::get('/addqty/{id}', [TransaksiController::class, 'addqty']);
        Route::get('/removeqty/{id}', [TransaksiController::class, 'removeqty']);
        Route::get('/savetransaksi', [TransaksiController::class, 'savetransaksi']);
    });
});
