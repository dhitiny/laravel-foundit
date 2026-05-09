<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class UserPostinganTemuanController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // User login: Lihat barang temuan miliknya sendiri (semua status)
            $semua_barang = Barang::where('id_user', Auth::id())
                                  ->where('jenis_barang', 'temuan')
                                  ->orderBy('id_item', 'desc')
                                  ->get();
        } else {
            // Tidak login: Tampilkan hanya yang sudah Approved untuk publik
            $semua_barang = Barang::where('jenis_barang', 'temuan')
                                  ->where('status', 'Approved')
                                  ->orderBy('id_item', 'desc')
                                  ->get();
        }

        return view('auth.statustemuanuser', compact('semua_barang'));
    }
}
