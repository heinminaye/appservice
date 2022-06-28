<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::fallback(function () {
    return abort(404);
});

Route::post('/create', [PostController::class, 'create']);
Route::get('/create', function () {
    return abort(404);
});

Route::get('/deletePost/{post}', [PostController::class, 'destroy']);

Route::post('/images/upload', [ImageController::class, 'store'])->name('images.store');
Route::get('/details/{post}', [PostController::class, 'show']);
Route::get('/', [PostController::class, 'search']);
Route::get('/category/{category}', [PostController::class, 'category']);
Route::get('/details/{post}', [PostController::class, 'details']);
Route::get('/editPost/{post}', [PostController::class, 'edit']);
Route::patch('/editPost/{post}', [PostController::class, 'update']);

Route::get('/adminLogin', [AdminController::class, 'index'])->middleware('guest');
Route::post('/adminLogin', [AdminController::class, 'admin'])->middleware('guest');
Route::get('/adminLogout', [AdminController::class, 'logout'])->middleware('auth');
Route::get('/logout', function () {
    return abort(404);
});
Route::get('/logout', function () {
    return abort(404);
});