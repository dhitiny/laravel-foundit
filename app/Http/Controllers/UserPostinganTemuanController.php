<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class UserPostinganTemuanController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // Jika login, lihat barang temuan miliknya sendiri
            $semua_barang = Barang::where('id_user', Auth::id())
                                  ->where('status', 'temuan')
                                  ->orderBy('id_item', 'desc')
                                  ->get();
        } else {
            // Jika tidak login, tampilkan semua barang temuan yang sudah Approved
            $semua_barang = Barang::where('status', 'temuan')
                                  ->where('status_admin', 'Approved')
                                  ->orderBy('id_item', 'desc')
                                  ->get();
        }

        return view('auth.statustemuanuser', compact('semua_barang'));
    }
}
