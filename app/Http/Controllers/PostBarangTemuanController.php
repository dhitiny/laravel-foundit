<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostBarangTemuan; 
use Illuminate\Support\Facades\Auth;

class PostBarangTemuanController extends Controller
{
    public function index()
    {
        $items = PostBarangTemuan::latest()->get();
        // REVISI: Pakai folder Temuan
        return view('PostBarangTemuan.index', compact('items'));
    }

    public function create()
    {
        // REVISI: Pakai folder Temuan
        return view('PostBarangTemuan.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name'   => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'found_date'  => 'required|date',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('found_items', 'public');
        }

        PostBarangTemuan::create([
            'user_id'     => Auth::id(),
            'item_name'   => $request->item_name,
            'location'    => $request->location,
            'found_date'  => $request->found_date,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('PostBarangTemuan.index')->with('success', 'Berhasil diposting!');
    }
}