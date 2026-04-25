<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\RegisterController;

use App\Http\Controllers\PostBarangTemuanController;
use App\Http\Controllers\PostBarangHilangController; 
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session; 
use App\Http\Controllers\UserPostinganHilangController;
use App\Http\Controllers\UserPostinganTemuanController;



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


// 1. Rute Publik
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// 2. Rute Dashboard (Bisa diakses semua yang login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Rute Profile (User Biasa)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Manajemen Akun (KHUSUS ADMIN)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::patch('/admin/users/{user}/status', [UserController::class, 'updateStatus'])->name('admin.users.updateStatus');
});

// 5. Logout Manual (Opsional, karena sudah ada di auth.php)
Route::post('/logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/');
})->name('logout');

// Memanggil rute bawaan Laravel Breeze (Login, Register, Reset Password)
require __DIR__.'/auth.php';

Route::get('/admin-postingan', [PostinganController::class, 'index'])->name('admin.index');
Route::get('/admin-postingan/terima/{id_item}', [PostinganController::class, 'terima'])->name('admin.postingan.terima');
Route::get('/admin-postingan/tolak/{id_item}', [PostinganController::class, 'tolak'])->name('admin.postingan.tolak');
Route::get('/admin-postingan/selesai/{id_item}', [PostinganController::class, 'selesai'])->name('admin.postingan.selesai');
Route::get('/status-temuan', [UserPostinganTemuanController::class, 'index']);
Route::get('/status-hilang', [UserPostinganHilangController::class, 'index']);
Route::delete('/barang/batal/{id}', [UserPostinganHilangController::class, 'destroy'])->name('barang.destroy');

