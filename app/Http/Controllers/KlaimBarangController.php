<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KlaimBarang;
use Illuminate\Http\Request;

class KlaimBarangController extends Controller
{
    public function create(Request $request, $id)
    {
        // Mencari data barang berdasarkan id_item
        $item = Barang::where('id_item', $id)->firstOrFail();

        // Menangkap parameter ?jenis= dari URL, default-nya 'klaim'
        $jenisForm = $request->query('jenis', 'klaim');

        // Mengarahkan ke view klaimbarang Anda dengan membawa data tambahan $jenisForm
        return view('klaimbarang.klaimbarang', compact('item', 'jenisForm'));
    }

    public function store(Request $request, $id)
    {
        // 1. Ambil data parameter jenis form dari input/request hidden atau query string
        $jenisForm = $request->input('jenis_form', 'klaim');

        // 2. Validasi Dinamis: Jika 'pengembalian', foto wajib diisi (required)
        $request->validate([
            'ciri_khusus' => 'required|min:10',
            'bukti_foto' => $jenisForm === 'pengembalian'
                            ? 'required|image|mimes:jpeg,png,jpg|max:2048'
                            : 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cari data barangnya
        $barang = Barang::where('id_item', $id)->firstOrFail();

        // 3. Proses upload foto bukti ke storage public
        $fotoPath = $request->hasFile('bukti_foto')
            ? $request->file('bukti_foto')->store('bukti_klaim', 'public')
            : null;

        // 4. Simpan data laporan klaim/pengembalian ke database
        KlaimBarang::create([
            'barang_id' => $barang->id_item,
            'user_id' => auth()->id(),
            'ciri_khusus' => $request->ciri_khusus,
            'bukti_foto' => $fotoPath,
            'status' => 'PENDING',
            // Jika di tabel KlaimBarang kamu punya kolom jenis untuk membedakan,
            // kamu bisa simpan nilainya di sini, contoh: 'jenis' => $jenisForm
        ]);

        // 5. Kunci status barang menjadi pending agar tidak diklaim orang lain secara bersamaan
        $barang->update([
            'status' => 'pending',
        ]);

        // 6. Redirect dengan pesan sukses yang dinamis mengikuti jenis aksi user
        $pesanSukses = $jenisForm === 'pengembalian'
            ? 'Formulir pengembalian berhasil dikirim! Pemilik laporan kehilangan akan segera memverifikasi.'
            : 'Klaim berhasil dikirim! Penemu barang telah dinotifikasi.';

        return redirect()->route('barang.detail', $id)->with('success', $pesanSukses);
    }

    /* =========================================================================
       TAMBAHAN BARU: FUNGSI UNTUK MENANGGAPI TOMBOL TERIMA DAN TOLAK NOTIFIKASI
       ========================================================================= */

    // 1. Fungsi Terima Klaim
    public function setuju($id)
    {
        // Cari data klaim berdasarkan ID
        $klaim = KlaimBarang::findOrFail($id);

        // Update status data klaim menjadi APPROVED
        $klaim->update([
            'status' => 'APPROVED',
        ]);

        // Update juga status barangnya menjadi 'claimed' agar tidak tampil lagi di pencarian utama
        if ($klaim->barang) {
            $klaim->barang->update([
                'status' => 'claimed',
            ]);
        }

        return redirect()->back()->with('success', 'Klaim barang berhasil disetujui! 🎉');
    }

    // 2. Fungsi Tolak Klaim
    public function tolak($id)
    {
        // Cari data klaim berdasarkan ID
        $klaim = KlaimBarang::findOrFail($id);

        // Update status data klaim menjadi REJECTED
        $klaim->update([
            'status' => 'REJECTED',
        ]);

        // Kembalikan status barang menjadi 'Approved' (bisa dicari/diklaim lagi oleh orang lain)
        if ($klaim->barang) {
            $klaim->barang->update([
                'status' => 'Approved',
            ]);
        }

        return redirect()->back()->with('error', 'Klaim barang telah ditolak. ❌');
    }

    public function tampilkanBukti($id)
    {
        // Ambil data klaim beserta relasi user pengaju dan data barangnya
        $klaim = KlaimBarang::with(['user', 'barang'])->findOrFail($id);

        // Lempar data ke file view buktiKlaim.blade.php
        return view('klaimbarang.buktiKlaim', compact('klaim'));
    }
}
