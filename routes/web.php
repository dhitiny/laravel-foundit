<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserPostinganHilangController;
use App\Http\Controllers\UserPostinganTemuanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk Admin (Dashboard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rute untuk User (Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

// Darurat Logout
Route::get('/logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();

    return redirect('/register');
});

require __DIR__.'/auth.php';

Route::get('/admin-postingan', [PostinganController::class, 'index'])->name('admin.index');
Route::get('/admin-postingan/terima/{id_item}', [PostinganController::class, 'terima'])->name('admin.postingan.terima');
Route::get('/admin-postingan/tolak/{id_item}', [PostinganController::class, 'tolak'])->name('admin.postingan.tolak');
Route::get('/admin-postingan/selesai/{id_item}', [PostinganController::class, 'selesai'])->name('admin.postingan.selesai');
Route::get('/status-temuan', [UserPostinganTemuanController::class, 'index']);
Route::get('/status-hilang', [UserPostinganHilangController::class, 'index']);
Route::delete('/barang/batal/{id}', [UserPostinganHilangController::class, 'destroy'])->name('barang.destroy');
