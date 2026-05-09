<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class DetailBarangController extends Controller
{
    public function show($id)
    {
        $item = Barang::with('user')->where('id_item', $id)->firstOrFail();

        return view('auth.detail-barang', compact('item'));
    }
}
