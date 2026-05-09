<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class UserPostinganHilangController extends Controller
{
    public function index()
    {
        $semua_barang = Barang::where('id_user', Auth::id())
                              ->where('jenis_barang', 'hilang')
                              ->orderBy('id_item', 'desc')
                              ->get();

        return view('auth.statushilanguser', compact('semua_barang'));
    }

    public function destroy($id)
    {
        // Cari barang berdasarkan ID dan milik user yang sedang login
        $barang = Barang::where('id_item', $id)->where('id_user', Auth::id())->firstOrFail();
        $barang->delete();

        return redirect()->back()->with('success', 'Laporan barang hilang berhasil dihapus!');
    }
}
