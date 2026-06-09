<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // 1. Fungsi Utama untuk Menampilkan Halaman Utama (Homepage)
    public function index(Request $request)
    {
        $barangHilang = Barang::where('status', 'Approved')
            ->where('jenis_barang', 'hilang')
            ->latest('id_item')
            ->take(4)
            ->get();

        $barangTemuan = Barang::where('status', 'Approved')
            ->where('jenis_barang', 'temuan')
            ->latest('id_item')
            ->take(4)
            ->get();

        return view('auth.homepage', compact('barangHilang', 'barangTemuan'));
    }

    // 2. Fungsi untuk Fitur Search (Pencarian) - SUNTIKAN DROPDOWN KATEGORI DI SINI
    // 2. Fungsi untuk Fitur Search (Pencarian) - VERSI FIX DROPDOWN MANUAL
    public function search(Request $request)
    {
        $query = $request->input('query');
        $kategoriDipilih = $request->input('kategori'); // Menangkap pilihan dari dropdown

        // Kita kunci daftar kategorinya di sini biar PASTI MUNCUL sesuai fotomu!
        $daftarKategori = ['Elektronik', 'Dokumen', 'Aksesoris', 'Pakaian', 'Lainnya'];

        // Mulai query dasar (Hanya barang yang di-approve admin)
        $baseQuery = Barang::where('status', 'Approved');

        // Filter 1: Berdasarkan nama barang atau lokasi jika user mengetik sesuatu
        if ($query) {
            $baseQuery->where(function ($q) use ($query) {
                $q->where('nama_barang', 'LIKE', "%{$query}%")
                  ->orWhere('lokasi', 'LIKE', "%{$query}%");
            });
        }

        // Filter 2: Berdasarkan kategori yang dipilih di dropdown
        if ($kategoriDipilih) {
            $baseQuery->where('kategori', $kategoriDipilih);
        }

        // Ambil datanya
        $results = $baseQuery->get();

        // Pisahkan ke masing-masing jenis barang untuk tab menu
        $barangHilang = $results->where('jenis_barang', 'hilang')->values();
        $barangTemuan = $results->where('jenis_barang', 'temuan')->values();

        // Lempar ke view
        return view('searchpage', compact('barangHilang', 'barangTemuan', 'query', 'daftarKategori', 'kategoriDipilih'));
    }

    // 3. Fungsi Result untuk Jaga-jaga Route Pencarian
    public function result(Request $request)
    {
        return $this->search($request);
    }

    // 4. Fungsi Menampilkan SEMUA daftar Barang Hilang
    public function allHilang()
    {
        $barangHilang = Barang::where('status', 'Approved')
            ->where('jenis_barang', 'hilang')
            ->latest('id_item')
            ->get();

        $barangTemuan = Barang::where('status', 'Approved')
            ->where('jenis_barang', 'temuan')
            ->latest('id_item')
            ->get();

        return view('PostBarangHilang.index', compact('barangHilang', 'barangTemuan'));
    }

    // 5. Fungsi Menampilkan SEMUA daftar Barang Temuan
    public function allTemuan()
    {
        $barangTemuan = Barang::where('status', 'Approved')
            ->where('jenis_barang', 'temuan')
            ->latest('id_item')
            ->get();

        $barangHilang = Barang::where('status', 'Approved')
            ->where('jenis_barang', 'hilang')
            ->latest('id_item')
            ->get();

        return view('PostBarangTemuan.index', compact('barangTemuan', 'barangHilang'));
    }
}
