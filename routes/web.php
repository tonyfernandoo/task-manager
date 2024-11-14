<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect()->route('tasks.index'); // atau halaman yang Anda inginkan
});

// Rute untuk task management
Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
});

// Rute untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
