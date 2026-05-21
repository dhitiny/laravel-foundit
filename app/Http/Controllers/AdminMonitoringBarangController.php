<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class AdminMonitoringBarangController extends Controller
{
    // 1. Ambil data khusus barang HILANG beserta User-nya
    public function hilang()
    {
        $semua_barang = Barang::with('user')
                              ->where('jenis_barang', 'hilang')
                              ->orderBy('id_item', 'desc')
                              ->get();

        return view('monitoring_hilang', compact('semua_barang'));
    }

    // 2. Ambil data khusus barang TEMUAN beserta User-nya
    public function temuan()
    {
        $semua_barang = Barang::with('user')
                              ->where('jenis_barang', 'temuan')
                              ->orderBy('id_item', 'desc')
                              ->get();

        return view('monitoring_temuan', compact('semua_barang'));
    }
}
