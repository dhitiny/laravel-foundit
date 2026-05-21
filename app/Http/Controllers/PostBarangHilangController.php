<?php

namespace App\Http\Controllers;

use App\Models\Barang;
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
            'lost_date' => 'required', // Rule |date dilepas agar input datetime-local terbaca mulus beserta jamnya
            'description' => 'required',
            'kategori' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('lost_items', 'public') : null;

        // Mengubah format string datetime-local menjadi format database Y-m-d H:i:s
        $formattedDate = date('Y-m-d H:i:s', strtotime($request->lost_date));

        Barang::create([
            'id_user' => auth()->id(),
            'nama_barang' => $request->item_name,
            'kategori' => $request->kategori,
            'deskripsi' => $request->description,
            'lokasi' => $request->location,
            'tanggal_kejadian' => $formattedDate,
            'foto_barang' => $imagePath,
            'jenis_barang' => 'hilang',
            'status' => 'pending',
        ]);

        return redirect()->route('status.hilang.user')->with('success', 'Laporan kehilangan berhasil diposting!');
    }
}
