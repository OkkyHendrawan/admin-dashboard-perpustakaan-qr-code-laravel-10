<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\AnggotaApiController;
use App\Http\Controllers\Api\ProfileApiController;

// Rute untuk autentikasi
Route::post('login', [AuthApiController::class, 'AuthLogin'])->name('login');
Route::post('forgot-password', [AuthApiController::class, 'forgotPassword']);
Route::post('reset-password/{token}', [AuthApiController::class, 'resetPassword']);
Route::get('logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileApiController::class, 'profile']);
    Route::put('/profile/update', [ProfileApiController::class, 'update']);
});

Route::get('anggota', [AnggotaApiController::class, 'index']);
Route::post('anggota', [AnggotaApiController::class, 'store']);
Route::get('anggota/{id}', [AnggotaApiController::class, 'show']);
Route::put('anggota/{id}', [AnggotaApiController::class, 'update']);
Route::delete('anggota/{id}', [AnggotaApiController::class, 'destroy']);
Route::get('anggota-search', [AnggotaApiController::class, 'search']);
