<?php

use App\Models\Blog;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\EnsureTokenIsValid;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog/add', [BlogController::class, 'add']);
    Route::post('/blog/create', [BlogController::class, 'create']);
    Route::get('/blog/{id}/detail', [BlogController::class, 'detail'])->name('blog-detail');
    Route::get('/blog/{id}/edit', [BlogController::class, 'edit']);
    Route::patch('/blog/{id}/update', [BlogController::class, 'update']);
    Route::get('/blog/{id}/delete', [BlogController::class, 'hapus']);
    Route::get('/blog/{id}/restore', [BlogController::class, 'restore']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/phones', function () {
        $phones = Phone::with('user')->get();
        return $phones;
    })->middleware('tokenvalid');

    Route::post('/comment/{blog_id}', [CommentController::class, 'store']);
    Route::get('/images', [ImageController::class, 'index']);

    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'store']);
});

Route::get('/upload', function () {
    Storage::disk('local')->put('example.txt', 'Contents');
});

Route::get('/thefile', function () {
    // return asset('storage/example.txt');
    return Storage::url('example.txt');
});
