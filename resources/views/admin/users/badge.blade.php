<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Atribut Kategori & Badge - FoundIt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { font-family: 'Poppins', sans-serif !important; }
        body { background-color: #fdfbf7; }
    </style>
</head>
<body class="text-gray-700 antialiased bg-[#fdfbf7]">

    <div class="fixed top-0 left-0 h-screen w-[260px] bg-[#041942] text-white p-6 z-50 flex flex-col justify-between shadow-xl">
        <div class="overflow-y-auto pr-1">
            <a href="{{ route('homepage') }}" class="block no-underline border-b border-white/10 pb-5 mb-6">
                <span class="font-extrabold text-2xl text-[#C11720]">Found</span><span class="font-extrabold text-2xl text-white">It</span>
                <span class="block text-xs font-normal text-gray-400 mt-1">Admin Workspace</span>
            </a>
            
            <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider block mb-3 px-2">Menu Manajemen</span>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-person-x-fill text-lg"></i> Blokir & Status User
            </a>
            
            <a href="{{ route('admin.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-postcard-heart-fill text-lg"></i> Manajemen Postingan
            </a>

            <a href="{{ route('admin.badge.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold text-white bg-[#C11720] shadow-md shadow-[#C11720]/20 mb-2">
                <i class="bi bi-award-fill text-lg text-white"></i> Master Badge & Kategori
            </a>
        </div>

        <div>
            <div class="px-2 mb-3">
                <a href="{{ route('homepage') }}" class="flex items-center justify-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold text-white bg-[#64748b] hover:bg-[#475569] transition-all shadow-inner tracking-wide w-full text-center">
                    &larr; Kembali ke Beranda
                </a>
            </div>
            <hr class="border-white/10 my-4">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-red-400/80 hover:text-red-500 w-full text-left transition-colors">
                    <i class="bi bi-power"></i> Log Out
                </button>
            </form>
        </div>
    </div>

    <div class="ml-[260px] p-8 max-w-[1600px] mx-auto space-y-8">
        
        <div class="flex justify-between items-center pb-4 border-b-2 border-[#0C324A]/5">
            <div class="flex items-center space-x-3">
                <div class="bg-[#0C324A]/10 p-2.5 rounded-2xl">
                    <i class="bi bi-award-fill text-2xl text-[#0C324A]"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-[#0C324A] tracking-tight">Manajemen Atribut Kategori & Badge</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Kelola data master kategori barang dan batasan target badge user langsung dari halaman ini</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 space-y-6 h-fit">
                <div class="border-b border-gray-100 pb-3">
                    <h3 class="text-base font-bold text-[#041942] flex items-center gap-2">
                        <i class="bi bi-plus-circle-fill text-[#C11720]"></i> Tambah Master Badge Baru
                    </h3>
                </div>

                <form id="formTambahBadge" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Nama Badge</label>
                        <input type="text" id="nama_badge" name="nama_badge" required
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-[#0C324A]/20 focus:border-[#0C324A] transition-all font-medium placeholder-gray-400 text-gray-700"
                               placeholder="Contoh: Honest Hero, Top Finder">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Deskripsi / Syarat Klaim</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-[#0C324A]/20 focus:border-[#0C324A] transition-all font-medium placeholder-gray-400 text-gray-700"
                                  placeholder="Contoh: Berhasil mengembalikan 5 barang temuan kepada pemiliknya"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Logo / Icon Gambar</label>
                        <input type="file" id="logo_badge" name="logo_badge" accept="image/*" required
                               class="block w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#C11720] text-white font-bold text-sm py-3 rounded-xl hover:bg-[#a6131a] transition-all shadow-md shadow-[#C11720]/10 flex items-center justify-center gap-2 cursor-pointer">
                        <i class="bi bi-cloud-arrow-up-fill text-base"></i> Terbitkan Master Badge
                    </button>
                </form>
            </div>

            <div class="lg:grid-cols-1 lg:col-span-2 space-y-4">
                <div class="flex items-center gap-2 px-1">
                    <i class="bi bi-list-stars text-[#041942] text-lg"></i>
                    <h3 class="text-base font-bold text-[#041942] tracking-tight">Daftar Koleksi Badge Saat Ini</h3>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[600px]">
                            <thead>
                                <tr class="bg-[#041942] text-white text-xs font-semibold tracking-wide uppercase">
                                    <th class="py-4 px-6 w-[15%]">Logo</th>
                                    <th class="py-4 px-4 w-[25%]">Nama Badge</th>
                                    <th class="py-4 px-4 w-[40%]">Deskripsi / Aturan Target</th>
                                    <th class="py-4 px-6 text-center w-[20%]">Aksi Data</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100 bg-white text-gray-600">
                                @forelse($semuaBadge as $badge)
                                    <tr class="hover:bg-gray-50/40 transition-all">
                                        <td class="py-4 px-6">
                                            <img src="{{ asset('storage/' . $badge->logo_badge) }}" 
                                                 alt="Logo" class="w-12 h-12 rounded-2xl object-cover border border-gray-100 shadow-sm bg-gray-50">
                                        </td>
                                        <td class="py-4 px-4 font-bold text-[#041942]">
                                            {{ $badge->nama_badge }}
                                        </td>
                                        <td class="py-4 px-4">
                                            <p class="text-gray-600 text-xs font-medium">{{ $badge->deskripsi ?? '-' }}</p>
                                            <span class="inline-block mt-1 text-[10px] bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold px-2 py-0.5 rounded-md uppercase">
                                                Target: {{ $badge->target_quantity }} Klaim/Lapor
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <form action="{{ route('admin.badge.destroy', $badge->id) }}" method="POST" class="inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus master badge ini?')"
                                                        class="bg-rose-50 text-rose-600 hover:bg-rose-100 font-bold text-xs px-3 py-2 rounded-xl transition-all cursor-pointer">
                                                    <i class="bi bi-trash3-fill"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-gray-400 italic py-12">
                                            <div class="flex flex-col items-center justify-center space-y-1">
                                                <i class="bi bi-award text-3xl text-gray-300"></i>
                                                <span class="text-xs">Belum ada master badge yang dibuat.</span>
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
    </div>

    <script>
        document.getElementById('formTambahBadge').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);

            Swal.fire({
                title: 'Sedang Memproses...',
                text: 'Harap tunggu data sedang dikirim ke server.',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            fetch("{{ route('admin.badge.store') }}", {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Master Badge baru berhasil diterbitkan ke halaman blade.',
                        icon: 'success',
                        confirmButtonColor: '#041942'
                    }).then(() => {
                        window.location.reload(); // Refresh halaman agar item baru muncul langsung di tabel
                    });
                } else {
                    Swal.fire('Gagal!', data.message || 'Terjadi kesalahan sistem.', 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error!', 'Tidak dapat terhubung ke server backend.', 'error');
            });
        });
    </script>
</body>
</html>