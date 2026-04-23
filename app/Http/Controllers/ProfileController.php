<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; // WAJIB ADA
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // 1. Ambil data teks (username & email)
        $user->fill($request->validated());

        // 2. Logika Simpan Foto
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada agar hemat storage
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            
            // Simpan foto baru ke folder 'profile_photos' di disk 'public'
            $path = $request->file('foto_profil')->store('profile_photos', 'public');
            $user->foto_profil = $path;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // ... function destroy tetap sama seperti bawaan
}