<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminMonitoringBarangController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\DetailBarangController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KlaimBarangController;
use App\Http\Controllers\PostBarangHilangController;
use App\Http\Controllers\PostBarangTemuanController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserPostinganHilangController;
use App\Http\Controllers\UserPostinganTemuanController; // <-- 1. IMPORT KATEGORI CONTROLLER DISINI
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

// 3. RUTE TERPROTEKSI (Harus Login)
Route::middleware(['auth'])->group(function () {
    // JALUR KHUSUS ADMIN (Akses Dashboard & Fiturnya)
    // ----------------------------------------------------
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        // Fitur Blokir / Ubah Status User
        Route::patch('/users/update-status/{id}', [UserController::class, 'updateStatus'])->name('users.updateStatus');

        // Fitur Atur Postingan Konten
        Route::get('/postingan', [PostinganController::class, 'index'])->name('index');
        Route::get('/postingan/terima/{barang}', [PostinganController::class, 'terima'])->name('postingan.terima');
        Route::get('/postingan/tolak/{barang}', [PostinganController::class, 'tolak'])->name('postingan.tolak');
        Route::get('/postingan/selesai/{barang}', [PostinganController::class, 'selesai'])->name('postingan.selesai');

        // Fitur Monitoring Barang
        Route::get('/monitoring-hilang', [AdminMonitoringBarangController::class, 'hilang'])->name('monitoring.hilang');
        Route::get('/monitoring-temuan', [AdminMonitoringBarangController::class, 'temuan'])->name('monitoring.temuan');

        // Fitur Tambah Badge Admin
        Route::get('/badge', [BadgeController::class, 'index'])->name('badge.index');
        Route::post('/badge/store', [BadgeController::class, 'store'])->name('badge.store');
        Route::delete('/badge/{id}', [BadgeController::class, 'destroy'])->name('badge.destroy');
    });

    // ----------------------------------------------------
    // JALUR KHUSUS USER BIASA
    // ----------------------------------------------------
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');
    Route::get('/badgeInfo', [BadgeController::class, 'index'])->name('profile.badge');
    Route::get('/search', [ItemController::class, 'search'])->name('search.results');
    Route::get('/searchpage', [ItemController::class, 'result'])->name('searchpage');
    Route::get('/barang-hilang', [ItemController::class, 'allHilang'])->name('barang.allHilang');
    Route::get('/barang-temuan', [ItemController::class, 'allTemuan'])->name('barang.allTemuan');

    // Lapor Barang
    Route::get('/PostBarangTemuan/create', [PostBarangTemuanController::class, 'create'])->name('PostBarangTemuan.create');
    Route::post('/PostBarangTemuan', [PostBarangTemuanController::class, 'store'])->name('PostBarangTemuan.store');
    Route::get('/PostBarangHilang/create', [PostBarangHilangController::class, 'create'])->name('PostBarangHilang.create');
    Route::post('/PostBarangHilang', [PostBarangHilangController::class, 'store'])->name('PostBarangHilang.store');

    // Detail & Status Postingan User
    Route::get('/barang/detail/{barang}', [DetailBarangController::class, 'show'])->name('barang.detail');
    Route::get('/status-temuan', [UserPostinganTemuanController::class, 'index'])->name('auth.statustemuanuser');
    Route::get('/status-hilang', [UserPostinganHilangController::class, 'index'])->name('auth.statushilanguser');

    // Kontrol Postingan Selesai / Hapus oleh User
    Route::post('/postingan/temuan/{id}/selesai', [ProfileController::class, 'postinganTemuanSelesai'])->name('user.postingan.temuan.selesai');
    Route::delete('/barang/batal/{barang}', [UserPostinganHilangController::class, 'destroy'])->name('user.postingan.hilang.destroy');
    Route::post('/user/postingan-hilang/{id}/selesai', [UserPostinganHilangController::class, 'setSelesai'])->name('user.postingan.hilang.selesai');
    Route::post('/user/postingan-temuan/{id}/selesai', [UserPostinganTemuanController::class, 'setSelesai'])->name('user.postingan.temuan.selesai');
    Route::delete('/user/postingan-temuan/destroy/{barang}', [UserPostinganTemuanController::class, 'destroy'])->name('user.postingan.temuan.destroy');

    // Form Klaim / Pengembalian Barang (Duplikat sudah dibersihkan, pakai parameter id_item)
    Route::get('/klaim/create/{id_item}', [KlaimBarangController::class, 'create'])->name('klaim.create');
    Route::post('/klaim/store/{id_item}', [KlaimBarangController::class, 'store'])->name('klaim.store');
    Route::post('/klaim/{id}/setuju', [KlaimBarangController::class, 'setuju'])->name('klaim.setuju');
    Route::post('/klaim/{id}/tolak', [KlaimBarangController::class, 'tolak'])->name('klaim.tolak');
    Route::get('/klaim/{id}/bukti', [KlaimBarangController::class, 'tampilkanBukti'])->name('klaim.bukti');

    // Profile User
    Route::get('/myprofile', [ProfileController::class, 'myprofile'])->name('profile.myprofile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ----------------------------------------------------
    // 2. ROUTE TAMBAHAN: SIMPAN KATEGORI VIA AJAX SWEETALERT
    // ----------------------------------------------------
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
});

// 4. LOGOUT
Route::post('/logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();

    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
