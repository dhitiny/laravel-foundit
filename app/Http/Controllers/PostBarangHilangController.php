<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostBarangHilangController extends Controller
{
public function index() {
$items = \App\Models\PostBarangHilang::latest()->get();
return view('PostBarangHilang.index', compact('items'));
}

public function create() {
    return view('PostBarangHilang.create');
}

public function store(Request $request) {
    $request->validate([
        'item_name' => 'required',
        'location' => 'required',
        'lost_date' => 'required|date',
        'description' => 'required',
        'image' => 'nullable|image|max:2048',
    ]);

    $path = $request->file('image') ? $request->file('image')->store('lost_items', 'public') : null;

    \App\Models\PostBarangHilang::create([
        'user_id' => auth()->id(),
        'item_name' => $request->item_name,
        'location' => $request->location,
        'lost_date' => $request->lost_date,
        'description' => $request->description,
        'image' => $path,
    ]);

    return redirect()->route('PostBarangHilang.index')->with('success', 'Laporan kehilangan berhasil diposting!');
}
}
