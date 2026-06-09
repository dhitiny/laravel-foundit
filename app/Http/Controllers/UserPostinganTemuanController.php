<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class UserPostinganTemuanController extends Controller
{
    // 1. Menampilkan Halaman Riwayat Postingan Temuan User
    public function index()
    {
        $semua_barang = Barang::where('id_user', Auth::id())
                              ->where('jenis_barang', 'temuan')
                              ->orderBy('id_item', 'desc')
                              ->get();

        return view('auth.statustemuanuser', compact('semua_barang'));
    }

    // 2. Mengubah Status Postingan Temuan Menjadi Selesai
    public function setSelesai($id)
    {
        $barang = Barang::where('id_item', $id)
                        ->where('id_user', Auth::id())
                        ->firstOrFail();

        $barang->status = 'Selesai';
        $barang->save();

        return redirect()->back()->with('success', 'Status laporan berhasil diubah menjadi Selesai!');
    }

    // 3. Menghapus Postingan Temuan (Tombol Keranjang Sampah)
    public function destroy($id)
    {
        $barang = Barang::where('id_item', $id)
                        ->where('id_user', Auth::id())
                        ->firstOrFail();

        $barang->delete();

        return redirect()->back()->with('success', 'Laporan temuan berhasil dihapus!');
    }
}
