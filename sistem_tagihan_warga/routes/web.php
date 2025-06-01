<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\pendudukController;
use App\Http\Controllers\userController;
use App\Http\Controllers\WargaController;
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

Route::get('/', [loginController::class, 'index']);
Route::post('/', [loginController::class, 'login'])->name('login');
Route::resource('warga', WargaController::class);
Route::resource('penduduk', pendudukController::class);
Route::resource('user',userController::class);
