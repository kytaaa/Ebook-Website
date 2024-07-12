<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Middleware untuk autentikasi dan admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('books', BookController::class);
});


// Route untuk halaman home setelah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
