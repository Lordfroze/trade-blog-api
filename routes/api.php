<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// prefix untuk menentukan endpoint
Route::prefix('posts')->group(function () {
    Route::get('/', [PostsController::class, 'index']); // mengambil semua data
    Route::post('/', [PostsController::class, 'store']); // menyimpan data
    Route::get('{id}', [PostsController::class, 'show']); // mengambil data berdasarkan id
    Route::put('{id}', [PostsController::class, 'update']); // mengupdate data berdasarkan id
    Route::delete('{id}', [PostsController::class, 'destroy']); // menghapus data berdasarkan id
});
