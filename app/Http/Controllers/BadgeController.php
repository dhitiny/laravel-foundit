<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function index()
    {
        // Ambil data users agar tabel daftar anggota komunitas di halaman tersebut tidak error/kosong
        $users = \App\Models\User::all();

        // Memanggil semua data master badge dari database
        $semuaBadge = \App\Models\Badge::all();

        // 🚀 PERBAIKAN UTAMA: Arahkan view ke folder admin/users/badge.blade.php
        return view('admin.users.badge', compact('users', 'semuaBadge'));
    }

    public function store(Request $request)
    {
        try {
            // 1. Hapus target_quantity dari validasi
            $request->validate([
                'nama_badge' => 'required|string|max:255',
                'logo_badge' => 'required|image|mimes:png,jpg,jpeg|max:1024',
                'deskripsi' => 'nullable|string',
            ]);

            if ($request->hasFile('logo_badge')) {
                $path = $request->file('logo_badge')->store('badges', 'public');
            } else {
                return response()->json(['success' => false, 'message' => 'File gambar logo tidak ditemukan.'], 400);
            }

            // 2. Hapus target_quantity dari proses create database
            $badge = \App\Models\Badge::create([
                'nama_badge' => $request->nama_badge,
                'deskripsi' => $request->deskripsi,
                'logo_badge' => $path,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Badge baru berhasil diterbitkan!',
                'data' => $badge,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
