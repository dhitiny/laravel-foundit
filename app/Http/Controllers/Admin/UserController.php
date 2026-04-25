<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() 
    {
        $users = User::all(); 
        return view('admin.users.index', compact('users'));
    }
    public function updateStatus(Request $request, $id)
{
    // 1. Validasi input sederhana
    $request->validate([
        'status' => 'required|in:aktif,non-aktif,banned',
    ]);

    // 2. Cari User dan Update secara langsung
    $user = \App\Models\User::findOrFail($id);
    $user->update([
        'status' => $request->status
    ]);

    // 3. Kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Status user ' . $user->username . ' berhasil diubah menjadi ' . $request->status);
}
}
