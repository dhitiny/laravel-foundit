<?php

namespace App\Http\Controllers;

use App\Models\Barang; // Pakai model Barang yang utama
use Illuminate\Http\Request;

class PostBarangHilangController extends Controller
{
    // Fungsi index kita hapus karena daftar postingan sudah diurus UserPostinganHilangController

    public function create()
    {
        return view('PostBarangHilang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'location' => 'required',
            'lost_date' => 'required|date',
            'description' => 'required',
            'kategori' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('lost_items', 'public') : null;

        Barang::create([
            'id_user' => auth()->id(),
            'nama_barang' => $request->item_name,
            'kategori' => $request->kategori,
            'deskripsi' => $request->description,
            'lokasi' => $request->location,
            'tanggal_kejadian' => $request->lost_date,
            'foto_barang' => $imagePath,
            'jenis_barang' => 'hilang',             // Pembeda di kolom jenis_barang
            'status' => 'pending',            // Status untuk admin
        ]);

        return redirect()->route('status.hilang.user')->with('success', 'Laporan kehilangan berhasil diposting!');
    }
}
