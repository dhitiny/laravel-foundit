<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostBarangTemuanController extends Controller
{
    public function create()
    {
        return view('PostBarangTemuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'location' => 'required',
            'found_date' => 'required',
            'description' => 'required',
            'kategori' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('found_items', 'public') : null;

        $formattedDate = date('Y-m-d H:i:s', strtotime($request->found_date));

        Barang::create([
            'id_user' => Auth::id(), // Pake Auth::id() biar Intelephense tenang
            'nama_barang' => $request->item_name,
            'kategori' => $request->kategori,
            'deskripsi' => $request->description,
            'lokasi' => $request->location,
            'tanggal_kejadian' => $formattedDate,
            'foto_barang' => $imagePath,
            'jenis_barang' => 'temuan',
            'status' => 'pending',
        ]);

        return redirect('/status-temuan')->with('success', 'Laporan temuan barang berhasil diposting!');
    }
}
