<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Middleware\JWTMiddleware;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Menghandle AUth
Route::post('register', [JWTAuthController::class, 'register']); // register
Route::post('login', [JWTAuthController::class, 'login']); // login

// prefix untuk menentukan endpoint posts
Route::middleware(JWTMiddleware::class)->prefix('posts')->group(function () {
    Route::get('/', [PostsController::class, 'index']); // mengambil semua data
    Route::post('/', [PostsController::class, 'store']); // menyimpan data
    Route::get('{id}', [PostsController::class, 'show']); // mengambil data berdasarkan id
    Route::put('{id}', [PostsController::class, 'update']); // mengupdate data berdasarkan id
    Route::delete('{id}', [PostsController::class, 'destroy']); // menghapus data berdasarkan id
});

// prefix untuk menentukan endpoint comments
// Menghandle Comment
Route::middleware(JWTMiddleware::class)->prefix('comments')->group(function () {
    Route::post('/', [CommentsController::class, 'store']); // Simpan komentar baru
    Route::delete('{id}', [CommentsController::class, 'destroy']); // Menghapus komentar
});

// Menghandle Messages
Route::middleware(JWTMiddleware::class)->prefix('messages')->group(function () {
    Route::post('/', [MessagesController::class, 'store']); // kirim pesan
    Route::get('{id}', [MessagesController::class, 'show']); // lihat detail pesan
    Route::get('/getMessages/{user_id}', [MessagesController::class, 'getMessages']);
    Route::delete('{id}', [MessagesController::class, 'destroy']); // Menghapus pesan
});
