<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::apiResource('/user', UserController::class);

    Route::apiResource('/keuangan', KeuanganController::class);

    Route::get('/profile', [UserController::class, 'GetUserInfo'])->name('profile');
    Route::get('/getkeuangan', [KeuanganController::class, 'getKeuangan'])->name('profile');
});
