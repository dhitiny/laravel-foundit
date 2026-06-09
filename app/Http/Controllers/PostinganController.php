<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class PostinganController extends Controller
{
    public function index()
    {
        // Mengambil data barang diurutkan berdasarkan id_item terbaru beserta data user pengunggahnya
        $semua_barang = Barang::with('user')->orderBy('id_item', 'desc')->get();

        return view('admin-postingan', compact('semua_barang'));
    }

    public function terima($id_item)
    {
        // Mencari data barang berdasarkan atribut id_item
        $barang = Barang::findOrFail($id_item);
        $barang->update(['status' => 'Approved']);

        return redirect()->back()->with('success', 'Laporan barang berhasil disetujui!');
    }

    public function tolak($id_item)
    {
        // Mencari data barang berdasarkan atribut id_item
        $barang = Barang::findOrFail($id_item);
        $barang->update(['status' => 'Rejected']);

        return redirect()->back()->with('success', 'Laporan barang telah ditolak.');
    }

    public function selesai($id_item)
    {
        // Mencari data barang berdasarkan atribut id_item
        $barang = Barang::findOrFail($id_item);
        $barang->update(['status' => 'Selesai']);

        return redirect()->back()->with('success', 'Status laporan berhasil diselesaikan.');
    }
}
