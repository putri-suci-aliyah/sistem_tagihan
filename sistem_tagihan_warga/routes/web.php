<?php

use App\Http\Controllers\GenerateExcelController;
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

// Menampilkan halaman login saat user mengakses /login
Route::get('/login', [loginController::class, 'index']);
// Menampilkan ke halaman login jika user mengakses URL root /
Route::get('/', [loginController::class, 'index']);

// Proses login saat form login disubmit (method POST)
Route::post('/login', [loginController::class, 'login'])->name('login');

// Proses logout user dan hapus session login
Route::post('/logout', [loginController::class, 'logout'])->name('logout');


// middleware('auth'): Menandakan bahwa semua rute di dalam group ini hanya dapat diakses
// oleh user yang sudah login (terautentikasi). auth: mengecek apakah user sudah login.
Route::middleware('auth')->group(function () {
    // Resource controller untuk data tagihan (CRUD otomatis)
    Route::resource('tagihan', TagihanController::class);
    // Resource controller untuk data warga penduduk (CRUD otomatis)
    Route::resource('warga_penduduk', WargaPendudukController::class);
    // Resource controller untuk data user (CRUD otomatis)
    Route::resource('user', userController::class);
    // Resource controller untuk transaksi tagihan (CRUD otomatis)
    Route::resource('transaksi', TransaksiController::class);
     // Route untuk mengekspor data ke Excel, dengan nama route export_excel
    Route::get('export_excel', [GenerateExcelController::class, 'export'])->name('export_excel');

    // Route untuk mengirim notifikasi WhatsApp kepada warga berdasarkan ID transaksi
    Route::put('transaksi/notifikasi_whatsapp/{id}', [TransaksiController::class, 'notifikasi_whatsapp']);

    Route::put('transaksi/pelunasan_tagihan/{id}', [TransaksiController::class, 'pelunasan_tagihan']);
});
