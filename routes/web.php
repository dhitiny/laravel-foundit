<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostBarangTemuanController;
use App\Http\Controllers\PostBarangHilangController; 
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserPostinganHilangController;
use App\Http\Controllers\UserPostinganTemuanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session; 

// 1. RUTE PUBLIK
Route::get('/', function () { 
    return view('welcome'); 
})->name('landing');

// Fitur Filter Barang (Punya Lu)
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// --- FITUR BARANG TEMUAN ---
Route::get('/PostBarangTemuan', [PostBarangTemuanController::class, 'index'])->name('PostBarangTemuan.index');
Route::get('/PostBarangTemuan/create', [PostBarangTemuanController::class, 'create'])->name('PostBarangTemuan.create');
Route::post('/PostBarangTemuan', [PostBarangTemuanController::class, 'store'])->name('PostBarangTemuan.store');

// --- FITUR BARANG HILANG ---
Route::get('/PostBarangHilang', [PostBarangHilangController::class, 'index'])->name('PostBarangHilang.index');
Route::get('/PostBarangHilang/create', [PostBarangHilangController::class, 'create'])->name('PostBarangHilang.create');
Route::post('/PostBarangHilang', [PostBarangHilangController::class, 'store'])->name('PostBarangHilang.store');


// 2. AUTH & DASHBOARD
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', function () { return view('auth.login'); })->name('login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    
    // Rute Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. MANAJEMEN AKUN (KHUSUS ADMIN)
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::patch('/admin/users/{user}/status', [UserController::class, 'updateStatus'])->name('admin.users.updateStatus');

    // 4. ADMIN POSTINGAN
    Route::get('/admin-postingan', [PostinganController::class, 'index'])->name('admin.index');
    Route::get('/admin-postingan/terima/{id_item}', [PostinganController::class, 'terima'])->name('admin.postingan.terima');
    Route::get('/admin-postingan/tolak/{id_item}', [PostinganController::class, 'tolak'])->name('admin.postingan.tolak');
    Route::get('/admin-postingan/selesai/{id_item}', [PostinganController::class, 'selesai'])->name('admin.postingan.selesai');

    // 5. STATUS USER
    Route::get('/status-temuan', [UserPostinganTemuanController::class, 'index']);
    Route::get('/status-hilang', [UserPostinganHilangController::class, 'index']);
    Route::delete('/barang/batal/{id}', [UserPostinganHilangController::class, 'destroy'])->name('barang.destroy');
});

// Logout
Route::post('/logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/');
})->name('logout');

// Bawaan Breeze
require __DIR__.'/auth.php';