<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class UserPostinganTemuanController extends Controller
{
    /**
     * Menampilkan daftar barang temuan milik user yang sedang login.
     */
    public function index()
    {
        if (Auth::check()) {
            // Jika login, lihat barang miliknya sendiri
            $semua_barang = Barang::where('id_user', Auth::id())
                            ->orderBy('created_at', 'desc')
                            ->get();
        } else {
            // Jika tidak login, tampilkan semua barang yang sudah disetujui Admin
            $semua_barang = Barang::where('status', 'Approved')
                            ->orderBy('created_at', 'desc')
                            ->get();
        }

        return view('auth.statustemuanuser', compact('semua_barang'));
    }
}
