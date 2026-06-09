<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Barang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function myprofile(Request $request): View
    {
        $user = $request->user();

        $barangTemuan = Barang::where('id_user', $user->id_user)->where('jenis_barang', 'temuan')->get();
        $barangHilang = Barang::where('id_user', $user->id_user)->where('jenis_barang', 'hilang')->get();

        // 🌟 LOGIKA REAL-TIME: Hitung jumlah barang temuan berstatus 'selesai'
        $jumlahSelesai = Barang::where('id_user', $user->id_user)
                               ->where('jenis_barang', 'temuan')
                               ->where('status', 'selesai')
                               ->count();

        // 🏆 Penentuan Badge dinamis sesuai request (Gold, Silver, Bronze)
        if ($jumlahSelesai >= 15) {
            // >= 15 dapet Gold (ID 3)
            $badgesDiterima = \App\Models\Badge::where('id', 3)->get();
        } elseif ($jumlahSelesai >= 10) {
            // >= 10 dapet Silver (ID 2)
            $badgesDiterima = \App\Models\Badge::where('id', 2)->get();
        } elseif ($jumlahSelesai >= 5) {
            // >= 5 dapet Bronze (ID 1)
            $badgesDiterima = \App\Models\Badge::where('id', 1)->get();
        } else {
            // Di bawah 5 barang belum dapet lencana
            $badgesDiterima = collect();
        }

        /* =========================================================================
           FIXED DI SINI: MENGGABUNGKAN ID BARANG TEMUAN DAN BARANG HILANG
           ========================================================================= */
        // Gabungkan seluruh ID item dari postingan temuan DAN kehilangan milik user ini
        $idBarangUser = $barangTemuan->pluck('id_item')->merge($barangHilang->pluck('id_item'));

        // Ambil data klaim MASUK (Verifikasi untuk semua barang milik user login)
        $klaimMasuk = \App\Models\KlaimBarang::whereIn('barang_id', $idBarangUser)
            ->where('status', 'PENDING') // Menampilkan yang butuh tindakan konfirmasi
            ->where('user_id', '!=', $user->id_user) // Proteksi: Jangan memunculkan klaim buatan diri sendiri
            ->with(['user', 'barang'])
            ->latest()
            ->get();

        // 2. Ambil riwayat klaim KELUAR milik user ini (Kotak biru informasi status)
        $notifKlaimSaya = \App\Models\KlaimBarang::where('user_id', $user->id_user)
            ->whereIn('status', ['PENDING', 'APPROVED', 'REJECTED'])
            ->with('barang')
            ->latest()
            ->get()
            ->unique('barang_id'); // Memastikan tidak duplikat/double untuk barang yang sama

        return view('profile.myprofile', [
            'username' => $user,
            'barangTemuan' => $barangTemuan,
            'barangHilang' => $barangHilang,
            'badgesDiterima' => $badgesDiterima,
            'klaimMasuk' => $klaimMasuk,
            'notifKlaimSaya' => $notifKlaimSaya,
        ]);
    }

    public function edit(Request $request): View
    {
        $user = $request->user();

        $barangTemuan = Barang::where('id_user', $user->id_user)->where('jenis_barang', 'temuan')->get();
        $barangHilang = Barang::where('id_user', $user->id_user)->where('jenis_barang', 'hilang')->get();

        // 🌟 Logika penentuan badge yang sama persis agar sinkron di halaman edit
        $jumlahSelesai = Barang::where('id_user', $user->id_user)
                               ->where('jenis_barang', 'temuan')
                               ->where('status', 'selesai')
                               ->count();

        if ($jumlahSelesai >= 15) {
            $badgesDiterima = \App\Models\Badge::where('id', 3)->get();
        } elseif ($jumlahSelesai >= 10) {
            $badgesDiterima = \App\Models\Badge::where('id', 2)->get();
        } elseif ($jumlahSelesai >= 5) {
            $badgesDiterima = \App\Models\Badge::where('id', 1)->get();
        } else {
            $badgesDiterima = collect();
        }

        return view('profile.edit', [
            'username' => $user,
            'barangTemuan' => $barangTemuan,
            'barangHilang' => $barangHilang,
            'badgesDiterima' => $badgesDiterima,
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->has('whatsapp')) {
            $user->whatsapp = $request->whatsapp;
        }

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $path = $request->file('foto_profil')->store('profile_photos', 'public');
            $user->foto_profil = $path;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function postinganTemuanSelesai($id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);

        if ($barang->id_user !== auth()->user()->id_user) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak akses untuk tindakan ini.');
        }

        $barang->status = 'selesai';
        $barang->save();

        $user = auth()->user();
        $jumlahSelesai = Barang::where('id_user', $user->id_user)
                               ->where('jenis_barang', 'temuan')
                               ->where('status', 'selesai')
                               ->count();

        // 🌟 Sinkronisasi penyimpanan teks penanda di kolom status user
        $userModel = \App\Models\User::where('id_user', $user->id_user)->first();

        if ($userModel) {
            $statusLama = $userModel->status ? $userModel->status : '';
            $badgeBaru = '';

            // Cek tingkatan milestone tertinggi yang baru saja dicapai
            if ($jumlahSelesai == 15 && !str_contains($statusLama, 'badge_3')) {
                $badgeBaru = 'badge_3';
                $namaBadgeAlert = 'Gold';
            } elseif ($jumlahSelesai == 10 && !str_contains($statusLama, 'badge_2')) {
                $badgeBaru = 'badge_2';
                $namaBadgeAlert = 'Silver';
            } elseif ($jumlahSelesai == 5 && !str_contains($statusLama, 'badge_1')) {
                $badgeBaru = 'badge_1';
                $namaBadgeAlert = 'Bronze';
            }

            // Jika ada level badge baru tercapai, simpan ke database dan tampilkan alert selamat
            if ($badgeBaru !== '') {
                $userModel->status = $statusLama ? $statusLama.','.$badgeBaru : $badgeBaru;
                $userModel->save();

                return redirect()->back()->with('success', "Barang berhasil diserahkan! Selamat, Anda naik peringkat dan mendapatkan lencana baru: {$namaBadgeAlert}! 🏆🎉");
            }
        }

        return redirect()->back()->with('success', 'Status barang berhasil diperbarui menjadi selesai.');
    }
}
