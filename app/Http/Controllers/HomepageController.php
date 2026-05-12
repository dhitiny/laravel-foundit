<?php

namespace App\Http\Controllers;

use App\Models\Barang;

// Pastikan ini ada

class HomepageController extends Controller
{
    public function index()
    {
        // Pastikan kolom database menggunakan id_item
        $barangHilang = Barang::where('jenis_barang', 'hilang')
            ->where('status', 'Approved')
            ->latest('id_item')
            ->get();

        $barangTemuan = Barang::where('jenis_barang', 'temuan')
            ->where('status', 'Approved')
            ->latest('id_item')
            ->get();

        return view('auth.homepage', compact('barangHilang', 'barangTemuan'));
    }
}
