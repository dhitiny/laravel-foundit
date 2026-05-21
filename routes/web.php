<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminMonitoringBarangController;
use App\Http\Controllers\DetailBarangController; // Pakai punya temen lu
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PostBarangHilangController;
use App\Http\Controllers\PostBarangTemuanController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserPostinganHilangController;
use App\Http\Controllers\UserPostinganTemuanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// 1. RUTE PUBLIK (Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// 2. AUTH & REGISTER
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', function () { return view('auth.login'); })->name('login');

// 3. RUTE TERPROTEKSI (HARUS LOGIN)
Route::middleware(['auth', 'verified'])->group(function () {
    // REDIRECT: Supaya pas login masuk ke Homepage, bukan Dashboard standar
    Route::get('/dashboard', function () {
        return redirect()->route('homepage');
    });

    // Homepage Utama (Pake Controller temen lu)
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

    // Fitur Search & Hasil
    Route::get('/search', [ItemController::class, 'search'])->name('search.results');
    Route::get('/searchpage', [ItemController::class, 'result'])->name('searchpage');

    // --- LAPOR BARANG ---
    Route::get('/PostBarangTemuan/create', [PostBarangTemuanController::class, 'create'])->name('PostBarangTemuan.create');
    Route::post('/PostBarangTemuan', [PostBarangTemuanController::class, 'store'])->name('PostBarangTemuan.store');
    Route::get('/PostBarangHilang/create', [PostBarangHilangController::class, 'create'])->name('PostBarangHilang.create');
    Route::post('/PostBarangHilang', [PostBarangHilangController::class, 'store'])->name('PostBarangHilang.store');

    // --- DETAIL & STATUS ---
    Route::get('/barang/detail/{barang}', [DetailBarangController::class, 'show'])->name('barang.detail');
    Route::get('/status-temuan', [UserPostinganTemuanController::class, 'index'])->name('status.temuan.user');
    Route::get('/status-hilang', [UserPostinganHilangController::class, 'index'])->name('status.hilang.user');
    Route::delete('/barang/batal/{barang}', [UserPostinganHilangController::class, 'destroy'])->name('user.postingan.hilang.destroy');

    // --- PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ADMIN ---
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin-postingan', [PostinganController::class, 'index'])->name('admin.index');
    Route::get('/admin-postingan/terima/{barang}', [PostinganController::class, 'terima'])->name('admin.postingan.terima');
    Route::get('/admin-postingan/tolak/{barang}', [PostinganController::class, 'tolak'])->name('admin.postingan.tolak');
    Route::get('/admin-postingan/selesai/{barang}', [PostinganController::class, 'selesai'])->name('admin.postingan.selesai');
    Route::get('/admin/monitoring-hilang', [AdminMonitoringBarangController::class, 'hilang'])->name('admin.monitoring.hilang');
    Route::get('/admin/monitoring-temuan', [AdminMonitoringBarangController::class, 'temuan'])->name('admin.monitoring.temuan');
});

// LOGOUT
Route::post('/logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();

    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
