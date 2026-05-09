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
        // Langsung update kolom status
        $barang->update(['status' => 'Approved']);

        return redirect()->back();
    }

    public function tolak($id_item)
    {
        $barang = Barang::findOrFail($id_item);
        $barang->update(['status' => 'Rejected']);

        return redirect()->back();
    }

    public function selesai($id_item)
    {
        $barang = Barang::findOrFail($id_item);
        $barang->update(['status' => 'Selesai']);

        return redirect()->back();
    }
}
