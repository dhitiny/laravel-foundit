<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class PostinganController extends Controller
{
    /**
     * Menampilkan semua data postingan untuk Admin.
     */
    public function index()
    {
        $semua_barang = Barang::orderBy('created_at', 'desc')->get();

        return view('admin-postingan', compact('semua_barang'));
    }

    /**
     * Menyetujui postingan (Status: Approved).
     */
    public function terima($id_item)
    {
        $barang = Barang::findOrFail($id_item);

        $barang->update(['status' => 'Approved']);

        return redirect()->back()->with('success', 'Postingan telah disetujui.');
    }

    /**
     * Menolak postingan (Status: Rejected).
     */
    public function tolak($id_item)
    {
        $barang = Barang::findOrFail($id_item);

        $barang->update(['status' => 'Rejected']);

        return redirect()->back()->with('error', 'Postingan telah ditolak.');
    }

    /**
     * Memvalidasi postingan selesai (Status: Selesai).
     */
    public function selesai($id_item)
    {
        $barang = Barang::findOrFail($id_item);

        $barang->update(['status' => 'Selesai']);

        return redirect()->back()->with('success', 'Postingan divalidasi SELESAI.');
    }
}
