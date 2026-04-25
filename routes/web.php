<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\UserController;


// 1. Rute Publik
Route::get('/', function () {
    return view('welcome');
})->name('landing');


// fitur filter barang
Route::get('/items', [ItemController::class, 'index'])->name('items.index');


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