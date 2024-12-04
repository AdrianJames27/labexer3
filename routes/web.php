<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/user/login', [HomeController::class, 'showLoginPage'])->name('loginPage');
Route::get('/user/register', [HomeController::class, 'showRegisterPage'])->name('registerPage');
Route::get('/post', [BlogPostController::class, 'index'])->name('blogPostIndex');

Route::post('/login', [HomeController::class, 'login'])->name('login');
Route::post('/register', [HomeController::class, 'register'])->name('register');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/post/get', [BlogPostController::class, 'getPosts'])->name('getPost');
Route::post('/post/store', [BlogPostController::class, 'store'])->name('storePost');
