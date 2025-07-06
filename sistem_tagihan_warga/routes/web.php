<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\pendudukController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiTagihanController;
use App\Http\Controllers\userController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\WargaPendudukController;
use Illuminate\Support\Facades\Route;

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


Route::get('/login', [loginController::class, 'index']);
Route::get('/', [loginController::class, 'index']);

Route::post('/login', [loginController::class, 'login'])->name('login');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');


// middleware('auth'): Menandakan bahwa semua rute di dalam group ini hanya dapat diakses
// oleh user yang sudah login (terautentikasi). auth: mengecek apakah user sudah login.
Route::middleware('auth')->group(function () {
    Route::resource('tagihan', TagihanController::class);
    Route::resource('warga_penduduk', WargaPendudukController::class);
    Route::resource('user', userController::class);
    Route::resource('transaksi', TransaksiController::class);

    Route::put('transaksi/notifikasi_whatsapp/{id}', [TransaksiController::class, 'notifikasi_whatsapp']);
    Route::put('transaksi/pelunasan_tagihan/{id}', [TransaksiController::class, 'pelunasan_tagihan']);
});
