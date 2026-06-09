<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'whatsapp' => 'nullable|numeric',
            'password' => ['required', 'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        $validatedData['password'] = Hash::make($validateData['password']);
        $validateData['role'] = 'user';

        User::create($validatedData);

        if ($user->role === 'admin') {
            return redirect('/dashboard')->with('success', 'Welcome Admin!');
        } else {
            return redirect('/homepage')->with('success', 'You are Registered! Welcome Founder.');
        }
    }
}
