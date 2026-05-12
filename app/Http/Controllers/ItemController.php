<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // 1. Fungsi untuk menampilkan semua barang + Filter Kategori
    public function index(Request $request)
    {
        $categories = Category::all(); // Ambil kategori buat dropdown
        $items = Barang::query(); // Mulai query dari tabel barang

        // Logika Filter: Kalau user pilih kategori, kita saring berdasarkan id_kategori
        if ($request->has('category') && $request->category != '') {
            $items->where('id_kategori', $request->category);
        }

        // Tampilkan hanya yang statusnya sudah 'Approved' oleh admin
        $items->where('status', 'Approved');

        return view('items.index', [
            'items' => $items->latest('id_item')->get(), // Ambil semua data terbaru
            'categories' => $categories,
        ]);
    }

    // 2. Fungsi untuk Search (Pencarian)
    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Barang::where('status', 'Approved')
            ->where(function ($q) use ($query) {
                $q->where('nama_barang', 'LIKE', "%{$query}%")
                  ->orWhere('lokasi', 'LIKE', "%{$query}%");
            })->get();

        $barangHilang = $results->where('jenis_barang', 'hilang');
        $barangTemuan = $results->where('jenis_barang', 'temuan');

        return view('searchpage', compact('barangHilang', 'barangTemuan', 'query'));
    }

    // 3. Fungsi Result (Biasanya sama dengan search, buat jaga-jaga kalau route manggil ini)
    public function result(Request $request)
    {
        return $this->search($request);
    }
}
