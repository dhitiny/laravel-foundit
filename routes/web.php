<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostBarangTemuanController;
use App\Http\Controllers\PostBarangHilangController; // JANGAN LUPA IMPORT INI LE
use Illuminate\Support\Facades\Route;

// 1. Rute Publik (BISA DIAKSES TANPA LOGIN)
Route::get('/', function () { return view('welcome'); })->name('landing');

// --- FITUR BARANG TEMUAN ---
Route::get('/PostBarangTemuan', [PostBarangTemuanController::class, 'index'])->name('PostBarangTemuan.index');
Route::get('/PostBarangTemuan/create', [PostBarangTemuanController::class, 'create'])->name('PostBarangTemuan.create');
Route::post('/PostBarangTemuan', [PostBarangTemuanController::class, 'store'])->name('PostBarangTemuan.store');

// --- FITUR BARANG HILANG (TAMBAHAN BARU) ---
Route::get('/PostBarangHilang', [PostBarangHilangController::class, 'index'])->name('PostBarangHilang.index');
Route::get('/PostBarangHilang/create', [PostBarangHilangController::class, 'create'])->name('PostBarangHilang.create');
Route::post('/PostBarangHilang', [PostBarangHilangController::class, 'store'])->name('PostBarangHilang.store');


// 2. Auth & Dashboard (Biarkan saja)
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', function () { return view('auth.login'); })->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';