<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class UserPostinganHilangController extends Controller
{
    public function index()
    {
        // Mengambil data barang milik user yang sedang login dengan kategori 'hilang'
        $semua_barang = Barang::where('id_user', Auth::id())
                              ->where('status', 'hilang')
                              ->orderBy('id_item', 'desc')
                              ->get();

        return view('auth.statushilanguser', compact('semua_barang'));
    }

    public function destroy($id)
    {
        $barang = Barang::where('id_item', $id)->where('id_user', Auth::id())->firstOrFail();

        // Opsional: Jika ingin hapus permanen dari DB
        $barang->delete();

        return redirect()->back()->with('success', 'Laporan barang hilang berhasil dihapus!');
    }
}
