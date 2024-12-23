<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Endpoint untuk mendapatkan data user yang sedang login, diproteksi oleh Sanctum
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Endpoint register dan login untuk autentikasi pengguna
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Endpoint yang diproteksi oleh middleware Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Endpoint CRUD produk menggunakan resource controller
    Route::apiResource('products', ProductController::class);

    // Endpoint tambahan: Pencarian produk berdasarkan nama
    Route::get('/products/search', [ProductController::class, 'search']);

    // Endpoint logout untuk menghapus token autentikasi
    Route::post('/logout', [AuthController::class, 'logout']);
});