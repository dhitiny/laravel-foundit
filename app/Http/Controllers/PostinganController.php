<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class PostinganController extends Controller
{
    public function index()
    {
        $semua_barang = Barang::orderBy('id_item', 'desc')->get();

        return view('admin-postingan', compact('semua_barang'));
    }

    public function terima($id_item)
    {
        $barang = Barang::findOrFail($id_item);
        $barang->update(['status_admin' => 'Approved']);

        return redirect()->back()->with('success', 'Postingan telah disetujui.');
    }

    public function tolak($id_item)
    {
        $barang = Barang::findOrFail($id_item);
        $barang->update(['status_admin' => 'Rejected']);

        return redirect()->back()->with('error', 'Postingan telah ditolak.');
    }

    public function selesai($id_item)
    {
        $barang = Barang::findOrFail($id_item);
        $barang->update(['status_admin' => 'Selesai']);

        return redirect()->back()->with('success', 'Laporan telah selesai.');
    }
}
