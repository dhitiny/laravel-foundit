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
    public function updateStatus(Request $request, User $user)
    {
    $user->status = $request->status; // Mengambil nilai dari <select name="status">
    $user->save(); // Menyimpan ke database

    return back()->with('success', 'Status berhasil diperbarui!');
    }
}
