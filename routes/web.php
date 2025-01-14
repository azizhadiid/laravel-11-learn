<?php

use App\Models\Blog;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

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
});

Route::post('/comment/{blog_id}', [CommentController::class, 'store']);
