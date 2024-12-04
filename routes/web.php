<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('/login', [HomeController::class, 'login'])->name('login');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

Route::get('/post', [BlogPostController::class, 'index'])->name('blogPostIndex');

Route::get('/post/get', [BlogPostController::class, 'getPosts'])->name('getPost');
Route::post('/post/store', [BlogPostController::class, 'store'])->name('storePost');
