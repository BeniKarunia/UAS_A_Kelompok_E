<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/bukus', [BukuController::class, 'getAll'])->name('allbuku');
Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify'); 
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', [UserController::class, 'showProfile']);
    Route::put('/profile', [UserController::class, 'updateProfile']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::resource('/buku', BukuController::class);
    Route::resource('/keranjang', KeranjangController::class);
    Route::delete('/clearkeranjang', [KeranjangController::class, 'destroyAll']);
    Route::resource('/transaksi', TransaksiController::class);    
});
