<?php

namespace App\Http\Controllers;

use App\Models\Barang; // Pakai model Barang yang sudah kita bahas tadi
use Illuminate\Http\Request;

class PostBarangTemuanController extends Controller
{
    // Fungsi index dihapus karena kita pakai UserPostinganTemuanController untuk lihat status

    public function create()
    {
        return view('PostBarangTemuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'location' => 'required',
            'found_date' => 'required|date',
            'description' => 'required',
            'kategori' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('found_items', 'public') : null;

        Barang::create([
            'id_user' => auth()->id(),
            'nama_barang' => $request->item_name,
            'kategori' => $request->kategori,
            'deskripsi' => $request->description,
            'lokasi' => $request->location,
            'tanggal_kejadian' => $request->found_date,
            'foto_barang' => $imagePath,
            'jenis_barang' => 'temuan',             // Pembeda di kolom jenis_barang
            'status' => 'pending',            // Status untuk admin
        ]);

        return redirect()->route('status.temuan.user')->with('success', 'Laporan temuan berhasil diposting!');
    }
}
