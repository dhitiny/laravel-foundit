<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class HomepageController extends Controller
{
    public function index()
    {
        // 1. Ambil semua barang hilang umum (untuk feed utama)
        $barangHilang = Barang::where('jenis_barang', 'hilang')
            ->where('status', 'Approved')
            ->latest('id_item')
            ->get();

        // 2. Ambil semua barang temuan umum (untuk feed utama)
        $barangTemuan = Barang::where('jenis_barang', 'temuan')
            ->where('status', 'Approved')
            ->latest('id_item')
            ->get();

        // 3. LOGIKA SMART MATCHING AI
        $rekomendasiTemuan = collect(); // Default kosong jika belum login atau tidak ada kecocokan

        if (auth()->check()) {
            // Ambil laporan kehilangan milik user yang sedang login (berdasarkan id_user / id yang relasi ke user)
            // Silakan sesuaikan nama kolom 'id_user' jika di databasemu berbeda (misal: 'user_id')
            $laporanHilangUser = Barang::where('id_user', auth()->id())
                ->where('jenis_barang', 'hilang')
                ->where('status', 'Approved')
                ->get();

            if ($laporanHilangUser->isNotEmpty()) {
                // Ambil daftar kategori unik dari barang hilang milik user
                $kategoriUser = $laporanHilangUser->pluck('kategori')->unique();

                // Pecah nama barang menjadi kata kunci individual (misal: "Dompet Kulit" -> ["dompet", "kulit"])
                $keywords = [];
                foreach ($laporanHilangUser as $lh) {
                    $cleanName = preg_replace('/[^a-zA-Z0-9\s]/', '', $lh->nama_barang); // bersihkan simbol
                    $split = explode(' ', strtolower(trim($cleanName)));
                    $keywords = array_merge($keywords, $split);
                }
                // Hilangkan duplikasi kata kunci dan kata yang terlalu pendek (misal: "di", "ke", "yg")
                $keywords = array_unique(array_filter($keywords, function ($word) {
                    return strlen($word) > 2;
                }));

                // Cari barang TEMUAN yang cocok dengan Kategori ATAU Kata Kunci Nama Barang hilang user
                $rekomendasiTemuan = Barang::where('jenis_barang', 'temuan')
                    ->where('status', 'Approved')
                    ->where(function ($query) use ($kategoriUser, $keywords) {
                        // Cocokkan berdasarkan kategori
                        $query->whereIn('kategori', $kategoriUser);

                        // ATAU cocokkan berdasarkan kemiripan nama barang dari kata kunci
                        foreach ($keywords as $word) {
                            $query->orWhere('nama_barang', 'LIKE', '%'.$word.'%');
                        }
                    })
                    ->latest('id_item')
                    ->take(4) // Batasi maksimal 4 barang rekomendasi terbaik agar halaman tidak kepanjangan
                    ->get();
            }
        }

        // Kirim variabel tambahan $rekomendasiTemuan ke view auth.homepage
        return view('auth.homepage', compact('barangHilang', 'barangTemuan', 'rekomendasiTemuan'));
    }
}
