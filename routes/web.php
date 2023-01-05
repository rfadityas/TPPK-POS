<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
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
    // Transaksi Route
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::prefix('transaksi')->group(function () {
        Route::get('/detailtransaksi/{id}', [TransaksiController::class, 'detail']);
        Route::get('/tambah', [TransaksiController::class, 'create']);
        Route::get('/store', [TransaksiController::class, 'store']);
        Route::get('/getcart', [TransaksiController::class, 'getcart']);
        Route::get('/destroy/{id}', [TransaksiController::class, 'destroy']);
        Route::get('/addqty/{id}', [TransaksiController::class, 'addqty']);
        Route::get('/removeqty/{id}', [TransaksiController::class, 'removeqty']);
        Route::get('/savetransaksi', [TransaksiController::class, 'savetransaksi']);
        Route::get('/semuatransaksi', [TransaksiController::class, 'semuatransaksi']);
        Route::get('/cek/{id}', [TransaksiController::class, 'cek']);
        Route::post('/searchcustomer', [TransaksiController::class, 'search'])->name('search.customer');
        Route::post('/simpancust', [TransaksiController::class, 'simpancust'])->name('simpan.customer');
        Route::post('/sendinvoicelog', [TransaksiController::class, 'sendinvoicelog'])->name('simpan.sendinvoicelog');
        Route::get('/laporan', [TransaksiController::class, 'laporan']);
        Route::get('/exportlaporan/{tanggalawal}/{tanggalakhir}', [TransaksiController::class, 'exportlaporan'])->name('export.laporan');
    });

    // Product Route
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/tambah', [ProductController::class, 'create']);
        Route::post('/store', [ProductController::class, 'store']);
        Route::get('/edit/{id}', [ProductController::class, 'edit']);
        Route::post('/update/{id}', [ProductController::class, 'update']);
        Route::get('/delete/{id}', [ProductController::class, 'delete']);
    });

    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::get('/tambah', [KategoriController::class, 'create']);
        Route::post('/store', [KategoriController::class, 'store']);
        Route::get('/edit/{id}', [KategoriController::class, 'edit']);
        Route::post('/update/{id}', [KategoriController::class, 'update']);
        Route::get('/delete/{id}', [KategoriController::class, 'delete']);
    });
});
