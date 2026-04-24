<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class UserPostinganHilangController extends Controller
{
    public function index()
    {
        // Untuk sementara Auth dimatikan sesuai permintaanmu biar bisa lihat hasil
        // Nanti kalau sudah kelar semua, aktifkan lagi baris di bawah ini:
        // $userId = Auth::id();

        // Ambil semua data barang (nanti ganti jadi milik user login)
        $semua_barang = Barang::orderBy('created_at', 'desc')->get();

        return view('auth.statushilanguser', compact('semua_barang'));
    }

    // FUNGSI BARU UNTUK MEMBATALKAN POSTINGAN
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Kita tidak hapus permanen, tapi ubah statusnya jadi 'Dibatalkan'
        // Supaya muncul di kotak statistik "Laporan Dibatalkan"
        $barang->status = 'Dibatalkan';
        $barang->save();

        return redirect()->back()->with('success', 'Laporan berhasil dibatalkan!');
    }
}
