<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostBarangHilang;
use App\Models\PostBarangTemuan;

class ItemController extends Controller
{
    public function index(Request $request)
{
    $categories = \App\Models\Category::all(); // Ambil semua kategori buat dropdown
    $items = \App\Models\Barang::query(); // Mulai query tabel barang

    // Logika Filter: Kalau user pilih kategori, kita saring
    if ($request->has('category') && $request->category != '') {
        $items->where('id_kategori', $request->category);
    }

    return view('items.index', [
        'items' => $items->get(),
        'categories' => $categories
    ]);
}
        public function search(Request $request)
    {
        $query = $request->input('query');

        $barangHilang = PostBarangHilang::where('item_name', 'LIKE', "%{$query}%")
                        ->orWhere('location', 'LIKE', "%{$query}%")
                        ->get();

        $barangTemuan = PostBarangTemuan::where('item_name', 'LIKE', "%{$query}%")
                        ->orWhere('location', 'LIKE', "%{$query}%")
                        ->get();

        return view('searchpage', compact('barangHilang', 'barangTemuan', 'query'));
    }

    public function result(Request $request)
{
    $query = $request->input('query');

    $barangHilang = \App\Models\PostBarangHilang::where('item_name', 'LIKE', "%{$query}%")
                    ->orWhere('location', 'LIKE', "%{$query}%")
                    ->get();

    $barangTemuan = \App\Models\PostBarangTemuan::where('item_name', 'LIKE', "%{$query}%")
                    ->orWhere('location', 'LIKE', "%{$query}%")
                    ->get();

    return view('searchpage', compact('barangHilang', 'barangTemuan', 'query'));
}
}
