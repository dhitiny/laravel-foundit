<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Illuminate\Support\Facades\Session; // Tambahkan ini

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
    
    // Aktivitas Saya (Kriteria: Pengguna memantau postingan/klaim)
    // Route::get('/aktivitas-saya', [ActivityController::class, 'index'])->name('aktivitas.saya');
});

// 4. Manajemen Akun (KHUSUS ADMIN)
// Sebaiknya tambahkan pengecekan role di sini
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