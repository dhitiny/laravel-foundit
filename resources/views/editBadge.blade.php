<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Badge User - FoundIt</title>
    <!-- Tailwind CSS, Google Fonts, & Bootstrap Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fdfbf7; }
        .table-fixed { table-layout: fixed; }
    </style>
</head>
<body class="text-gray-700 antialiased bg-[#fdfbf7]">

    <!-- 1. SIDEBAR KIRI TETAP (FIXED SIDEBAR) - KEMBAR IDENTIK -->
    <div class="fixed top-0 left-0 h-screen w-[260px] bg-[#041942] text-white p-6 z-50 flex flex-col justify-between shadow-xl">
        <div class="overflow-y-auto pr-1 custom-scrollbar">
            <a href="{{ route('homepage') }}" class="block no-underline border-b border-white/10 pb-5 mb-6">
                <span class="font-extrabold text-2xl text-[#C11720]">Found</span><span class="font-extrabold text-2xl text-white">It</span>
                <span class="block text-xs font-normal text-gray-400 mt-1">Admin Workspace</span>
            </a>
            
            <!-- GROUP 1: MASTER DATA MANAJEMEN -->
            <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider block mb-3 px-2">Menu Manajemen</span>
            
            <!-- Menu 1: Blokir User -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-person-x-fill text-lg"></i> Blokir & Status User
            </a>
            
            <!-- Menu 2: Atur Postingan -->
            <a href="{{ route('admin.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-postcard-heart-fill text-lg"></i> Manajemen Postingan
            </a>

            <!-- Menu 3: Tambah Kategori (Pop-up Modal instan tetap dipertahankan) -->
            <a href="#" onclick="openModalKategori()" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-tags-fill text-lg text-amber-400"></i> Master Kategori
            </a>

            <!-- Menu 4: Tambah Badge (SEKARANG AKTIF KE HALAMAN VIEW INI) -->
            <!-- *Catatan: Pastikan isi href ini sesuai dengan nama rute halaman baru ini* -->
            <a href="{{ route('admin.badge.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold text-white bg-[#C11720] shadow-md shadow-[#C11720]/20 mb-2">
                <i class="bi bi-award-fill text-lg text-white"></i> Master Badge User
            </a>
            
            <!-- GROUP 2: MONITORING JALUR -->
            <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider block mt-6 mb-3 px-2">Menu Monitoring</span>
            
            <!-- Menu 5: Monitor Barang Hilang -->
            <a href="{{ route('admin.monitoring.hilang') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-search-heart text-lg"></i> Monitor Barang Hilang
            </a>
            
            <!-- Menu 6: Monitor Barang Temuan -->
            <a href="{{ route('admin.monitoring.temuan') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-box-seam-fill text-lg"></i> Monitor Barang Temuan
            </a>
        </div>

        <div>
            <hr class="border-white/10 my-4">
            <a href="{{ route('homepage') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:text-white transition-colors">
                <i class="bi bi-arrow-left-square"></i> Kembali ke Website
            </a>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-red-400/80 hover:text-red-500 w-full text-left transition-colors">
                    <i class="bi bi-power"></i> Log Out
                </button>
            </form>
        </div>
    </div>

    <!-- 2. HALAMAN UTAMA KONTEN -->
    <div class="ml-[260px] p-8 max-w-[1600px] mx-auto space-y-8">
        
        <!-- HEADER PANEL -->
        <div class="flex justify-between items-center pb-4 border-b-2 border-[#0C324A]/5">
            <div class="flex items-center space-x-3">
                <div class="bg-emerald-500/10 p-2.5 rounded-2xl">
                    <i class="bi bi-award-fill text-2xl text-emerald-600"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-[#0C324A] tracking-tight">Master Pengaturan Badge</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Buat badge apresiasi otomatis berdasarkan loyalitas laporan user</p>
                </div>
            </div>
            <span class="bg-[#0C324A] text-white text-xs font-bold px-4 py-2 rounded-full shadow-sm tracking-wider uppercase">
                Apresiasi Komunitas
            </span>
        </div>

        <!-- NOTIFIKASI SUCCESS -->
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl shadow-sm flex items-center space-x-3" role="alert">
                <i class="bi bi-check-circle-fill text-xl text-emerald-500"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- LAYOUT GRID FORM & TABEL -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-start">
            
            <!-- PANEL KIRI: FORM BUAT BADGE BARU (1 BAGIAN) -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 space-y-5">
                <div>
                    <h3 class="text-base font-bold text-[#0C324A]">Terbitkan Badge Baru</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Isi data di bawah untuk menambahkan jenis badge baru</p>
                </div>
                
                <!-- *Catatan: enctype="multipart/form-data" WAJIB untuk upload file/gambar* -->
                <form action="{{ route('admin.badge.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 m-0">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Nama Badge</label>
                        <input type="text" name="nama_badge" required class="w-full text-sm bg-gray-50/50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#0C324A] focus:bg-white transition-all shadow-inner" placeholder="Contoh: Honest Finder, Hero Level 1">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Syarat Minimal Klaim / Lapor</label>
                        <div class="relative rounded-xl shadow-inner">
                            <input type="number" name="minimal_laporan" min="1" required class="w-full text-sm bg-gray-50/50 border border-gray-200 rounded-xl pl-4 pr-24 py-3 focus:outline-none focus:border-[#0C324A] focus:bg-white transition-all" placeholder="Contoh: 5">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <span class="text-xs font-bold text-gray-400">Postingan</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Upload Gambar / Ikon Badge</label>
                        <div class="border-2 border-dashed border-gray-200 hover:border-[#0C324A] rounded-2xl p-4 transition-all text-center relative bg-gray-50/30">
                            <input type="file" name="gambar_badge" required accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" id="badgeImageInput" onchange="previewImage(event)">
                            <div id="uploadPlaceholder" class="space-y-1">
                                <i class="bi bi-image-fill text-2xl text-gray-300 block"></i>
                                <span class="text-xs font-medium text-gray-500 block">Pilih file gambar atau seret ke sini</span>
                                <span class="text-[10px] text-gray-400 block">Format: PNG, JPG, JPEG (Max. 2MB)</span>
                            </div>
                            <!-- Image Preview Generator -->
                            <img id="imagePreview" class="hidden mx-auto w-20 h-20 object-contain rounded-lg p-1 bg-white border border-gray-100 shadow-sm" alt="Preview Image">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#0C324A] text-white font-bold text-xs py-3.5 rounded-xl hover:bg-[#061e2e] transition-all shadow-md flex items-center justify-center gap-2 tracking-wide">
                        <i class="bi bi-plus-circle-fill"></i> SIMPAN DAN TERBITKAN
                    </button>
                </form>
            </div>

            <!-- PANEL KANAN: TABEL DAFTAR BADGE AKTIF (2 BAGIAN) -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden xl:col-span-2">
                <div class="p-6 border-b border-gray-50 bg-gray-50/30">
                    <h3 class="text-sm font-bold text-[#0C324A] flex items-center gap-2">
                        <i class="bi bi-shield-check text-emerald-500"></i> Koleksi Badge Aktif Komunitas
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse table-fixed min-w-[500px]">
                        <thead>
                            <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                <th class="py-4 pl-6 w-[20%]">Ikon / Gambar</th>
                                <th class="py-4 w-[40%]">Nama Badge</th>
                                <th class="py-4 w-[25%]">Syarat Minimum</th>
                                <th class="py-4 pr-6 text-center w-[15%]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-50 text-gray-600">
                            <!-- Variabel $badges dikirim dari controller backend kamu -->
                            @forelse($badges ?? [] as $badge)
                                <tr class="hover:bg-gray-50/40 transition-all">
                                    <!-- Kolom Gambar -->
                                    <td class="py-4 pl-6">
                                        @if($badge->gambar_badge)
                                            <img src="{{ asset('storage/' . $badge->gambar_badge) }}" class="w-12 h-12 object-contain" alt="Badge">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 border border-gray-200/50">
                                                <i class="bi bi-patch-question-fill text-xl"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <!-- Kolom Nama Badge -->
                                    <td class="py-4 font-bold text-[#0C324A] pr-4">
                                        <div class="truncate" title="{{ $badge->nama_badge }}">{{ $badge->nama_badge }}</div>
                                    </td>
                                    <!-- Kolom Syarat -->
                                    <td class="py-4 font-medium text-gray-700">
                                        <span class="bg-emerald-50 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-md border border-emerald-100">
                                            🎯 {{ $badge->minimal_laporan }} Laporan
                                        </span>
                                    </td>
                                    <!-- Kolom Hapus -->
                                    <td class="py-4 pr-6 text-center">
                                        <form action="{{ route('admin.badge.destroy', $badge->id_badge) }}" method="POST" class="m-0 inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah kamu yakin ingin menghapus master badge ini?')" class="text-gray-400 hover:text-red-500 p-2 rounded-xl hover:bg-rose-50 transition-all">
                                                <i class="bi bi-trash3 text-base"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-gray-400 italic py-16">
                                        <div class="flex flex-col items-center justify-center space-y-2">
                                            <i class="bi bi-award text-4xl text-gray-300"></i>
                                            <span class="text-sm">Belum ada koleksi badge yang dibuat.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

    <!-- LOGIKA JAVASCRIPT DETEKSI INPUT -->
    <script>
        // 1. Fungsi Preview Gambar Unggahan Instan Sebelum di-Submit
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('uploadPlaceholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // 2. Fungsi Pembantu: Modal Kategori (Agar Sinkron saat diklik di sidebar)
        function openModalKategori() {
            Swal.fire({
                title: 'Tambah Kategori Baru',
                html: `<input id="swal-kategori" class="swal2-input" style="font-size:0.95rem;" placeholder="Contoh: Elektronik, Dokumen">`,
                icon: 'tags',
                showCancelButton: true,
                confirmButtonColor: '#0C324A',
                confirmButtonText: 'Simpan Kategori',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[1.5rem]' },
                preConfirm: () => {
                    const kategori = document.getElementById('swal-kategori').value;
                    if (!kategori) { Swal.showValidationMessage('Nama kategori tidak boleh kosong!'); }
                    return { nama_kategori: kategori }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Berhasil!', `Kategori "${result.value.nama_kategori}" telah ditambahkan.`, 'success');
                }
            });
        }
    </script>
</body>
</html>