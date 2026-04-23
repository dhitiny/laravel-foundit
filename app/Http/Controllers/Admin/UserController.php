<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
    // Kriteria: Menampilkan daftar seluruh User (Nama, Email, Tanggal Bergabung)
    $users = \App\Models\User::all(); 
    return view('admin.users.index', compact('users'));
}

public function updateStatus(Request $request, \App\Models\User $user)
{
    // Kriteria: Admin dapat mengubah status akun (Aktif/Non-aktif/Banned)
    $user->update(['status' => $request->status]);
    return back()->with('success', 'Status akun berhasil diperbarui.');
}
}
