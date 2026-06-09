<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request; // Sesuaikan dengan nama model Kategori kamu

class KategoriController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input data
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ]);

        // Simpan ke tabel kategori
        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Kembalikan response JSON agar bisa dibaca oleh JavaScript SweetAlert
        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil disimpan',
            'data' => $kategori, // Berisi id_kategori dan nama_kategori baru
        ], 201);
    }
}
