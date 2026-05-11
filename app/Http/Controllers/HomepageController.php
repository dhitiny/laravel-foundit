<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $barangHilang = \App\Models\PostBarangHilang::latest()->take(5)->get();
        $barangTemuan = \App\Models\PostBarangTemuan::latest()->take(5)->get();

        return view('homepage', compact('barangHilang', 'barangTemuan'));
    }
}
