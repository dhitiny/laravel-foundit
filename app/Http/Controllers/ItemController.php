<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
