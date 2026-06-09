<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class AdminMonitoringBarangController extends Controller
{
    // Menampilkan halaman monitoring barang hilang untuk admin
    public function hilang()
    {
        // Diubah menjadi $semua_barang agar cocok dengan file HTML view kamu
        $semua_barang = Barang::where('jenis_barang', 'hilang')
                               ->orderBy('id_item', 'desc')
                               ->get();

        // Tetap mengarah ke file 'monitoring_hilang' sesuai struktur asli kamu
        return view('monitoring_hilang', compact('semua_barang'));
    }

    // Menampilkan halaman monitoring barang temuan untuk admin
    public function temuan()
    {
        // Diubah menjadi $semua_barang agar polanya kembar rapi
        $semua_barang = Barang::where('jenis_barang', 'temuan')
                               ->orderBy('id_item', 'desc')
                               ->get();

        // Tetap mengarah ke file 'monitoring_temuan' sesuai struktur asli kamu
        return view('monitoring_temuan', compact('semua_barang'));
    }
}
