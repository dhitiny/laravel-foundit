<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini agar tidak error

class PostBarangHilangController extends Controller
{
    public function create()
    {
        return view('PostBarangHilang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'location' => 'required',
            'lost_date' => 'required',
            'description' => 'required',
            'kategori' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('lost_items', 'public') : null;

        // Mengubah format string datetime-local menjadi format database Y-m-d H:i:s
        $formattedDate = date('Y-m-d H:i:s', strtotime($request->lost_date));

        Barang::create([
            'id_user' => Auth::id(), // Diubah dari auth()->id() ke Auth::id()
            'nama_barang' => $request->item_name,
            'id_kategori' => $request->id_kategori, // <-- INI YANG HILANG! Lu harus kirim ID-nya (Angka 1/2/3), bukan cuma teks "Elektronik"
            'kategori' => $request->kategori,
            'deskripsi' => $request->description,
            'lokasi' => $request->location,
            'tanggal_kejadian' => $formattedDate,
            'foto_barang' => $imagePath,
            'jenis_barang' => 'hilang',
            'status' => 'pending',
        ]);

        return redirect()->to('/status-hilang')->with('success', 'Laporan kehilangan berhasil diposting!');
    }
}
