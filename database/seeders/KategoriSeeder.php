<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder; // Panggil Model Kategori lu

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        // Data kategori yang mau lu masukin
        $dataKategori = [
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Dokumen & Surat'],
            ['nama_kategori' => 'Pakaian & Aksesoris'],
            ['nama_kategori' => 'Kunci & Dompet'],
            ['nama_kategori' => 'Lain-lain'],
        ];

        foreach ($dataKategori as $kategori) {
            Kategori::create($kategori);
        }
    }
}
