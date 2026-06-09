<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Postingan - FoundIt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { font-family: 'Poppins', sans-serif !important; }
        body { background-color: #fdfbf7; }
        .table-fixed { table-layout: fixed; }
    </style>
</head>
<body class="text-gray-700 antialiased bg-[#fdfbf7]">

    <div class="fixed top-0 left-0 h-screen w-[260px] bg-[#041942] text-white p-6 z-50 flex flex-col justify-between shadow-xl">
        <div class="overflow-y-auto pr-1 custom-scrollbar">
            <a href="{{ route('homepage') }}" class="block no-underline border-b border-white/10 pb-5 mb-6">
                <span class="font-extrabold text-2xl text-[#C11720]">Found</span><span class="font-extrabold text-2xl text-white">It</span>
                <span class="block text-xs font-normal text-gray-400 mt-1">Admin Workspace</span>
            </a>
            
            <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider block mb-3 px-2">Menu Manajemen</span>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-person-x-fill text-lg"></i> Blokir & Status User
            </a>
            
            <a href="{{ route('admin.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold text-white bg-[#C11720] shadow-md shadow-[#C11720]/20 mb-2">
                <i class="bi bi-postcard-heart-fill text-lg"></i> Manajemen Postingan
            </a>

            <a href="#" onclick="openModalKategori()" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-tags-fill text-lg text-amber-400"></i> Master Kategori
            </a>

            <a href="#" onclick="openModalBadge()" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-award-fill text-lg text-emerald-400"></i> Master Badge User
            </a>
            
            <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider block mt-6 mb-3 px-2">Menu Monitoring</span>
            
            <a href="{{ route('admin.monitoring.hilang') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-search-heart text-lg"></i> Monitor Barang Hilang
            </a>
            
            <a href="{{ route('admin.monitoring.temuan') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-box-seam-fill text-lg"></i> Monitor Barang Temuan
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

    <div class="ml-[260px] p-8 max-w-[1600px] mx-auto space-y-6">
        
        <div class="flex justify-between items-center pb-4 border-b-2 border-[#0C324A]/5">
            <div class="flex items-center space-x-3">
                <div class="bg-[#0C324A]/10 p-2.5 rounded-2xl">
                    <i class="bi bi-postcard-heart-fill text-2xl text-[#0C324A]"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-[#0C324A] tracking-tight">Daftar Antrean Postingan Barang</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Moderasi, tinjau laporan, dan ubah status postingan barang secara berkala</p>
                </div>
            </div>
            <span class="bg-[#041942] text-white text-xs font-bold px-4 py-2 rounded-full shadow-sm tracking-wider">
                {{ count($semua_barang) }} TOTAL POSTINGAN
            </span>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl shadow-sm flex items-center justify-between" role="alert">
                <div class="flex items-center space-x-3">
                    <i class="bi bi-check-circle-fill text-xl text-emerald-500"></i>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 justify-between items-center">
            <div class="relative w-full md:w-[480px]">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                    <i class="bi bi-search text-sm"></i>
                </span>
                <input type="text" id="postSearch" onkeyup="liveSearchPosts()" 
                       class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 text-sm rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0C324A]/20 focus:border-[#0C324A] transition-all font-medium placeholder-gray-400 text-gray-700" 
                       placeholder="Cari nama barang, deskripsi, lokasi...">
            </div>
            <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                <span class="text-xs text-gray-400 font-semibold bg-gray-50 px-3 py-2 rounded-xl border border-gray-100">
                    <i class="bi bi-filter-left text-[#0C324A] mr-1 text-sm"></i> Terfilter: <span id="postCount" class="font-bold text-[#0C324A]">0</span> postingan
                </span>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-fixed min-w-[1200px]">
                    <thead>
                        <tr class="bg-[#041942] text-white text-xs font-semibold tracking-wide uppercase">
                            <th class="py-4.5 pl-6 w-[10%]">Foto Barang</th> 
                            <th class="py-4.5 px-2 w-[8%]">ID</th>
                            <th class="py-4.5 px-3 w-[20%]">Nama Barang</th>
                            <th class="py-4.5 px-3 w-[24%]">Deskripsi</th>
                            <th class="py-4.5 px-3 w-[14%]">Lokasi Kejadian</th>
                            <th class="py-4.5 px-3 w-[12%]">Waktu</th>
                            <th class="py-4.5 px-3 w-[10%] text-center">Status</th>
                            <th class="py-4.5 pr-6 w-[12%] text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100 bg-white text-gray-600">
                        @forelse($semua_barang as $item)
                            <tr class="hover:bg-gray-50/40 transition-all">
                                <td class="py-4 pl-6">
                                    @if($item->foto_barang)
                                        <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="Foto" class="w-14 h-14 object-cover rounded-2xl border border-gray-200 shadow-sm">
                                    @else
                                        <div class="w-14 h-14 bg-gray-50 text-gray-400 rounded-2xl flex flex-col items-center justify-center text-[10px] border border-dashed border-gray-200 font-semibold select-none">
                                            <i class="bi bi-image text-base mb-0.5 text-gray-300"></i> No Pic
                                        </div>
                                    @endif
                                </td>

                                <td class="py-4 px-2 font-mono text-xs text-gray-400">
                                    #{{ $item->id_item }}
                                </td>

                                <td class="py-4 px-3 font-bold text-[#041942] truncate" title="{{ $item->nama_barang }}">
                                    {{ $item->nama_barang }}
                                </td>

                                <td class="py-4 px-3 text-gray-500 text-xs truncate" title="{{ $item->deskripsi }}">
                                    {{ Str::limit($item->deskripsi, 50, '...') ?? 'Tidak ada deskripsi' }}
                                </td>

                                <td class="py-4 px-3 text-gray-500 text-xs truncate" title="{{ $item->lokasi }}">
                                    <span class="inline-flex items-center"><i class="bi bi-geo-alt-fill text-gray-400 mr-1 text-[11px]"></i> {{ $item->lokasi ?? 'Lokasi tidak diisi' }}</span>
                                </td>

                                <td class="py-4 px-3 text-gray-500 text-xs">
                                    {{ $item->tanggal_kejadian ?? '-' }}
                                </td>

                                <td class="py-4 px-3 text-center">
                                    @php
                                        $statusItem = strtolower(trim($item->status ?? 'pending'));
                                        $badgeStyle = match($statusItem) {
                                            'aktif', 'approved', 'disetujui' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'ditolak', 'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                                            default => 'bg-amber-50 text-amber-700 border-amber-200',
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded border text-[9px] font-bold tracking-wider uppercase {{ $badgeStyle }}">
                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td class="py-4 pr-6 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="button" 
                                                onclick="konfirmasiSetuju('{{ route('admin.postingan.terima', $item->id_item) }}', '{{ $item->nama_barang }}')"
                                                class="bg-emerald-600 hover:bg-emerald-700 text-white text-[11px] font-bold px-3 py-1.5 rounded-xl transition-all shadow-sm shadow-emerald-600/10 cursor-pointer flex items-center gap-1">
                                            <i class="bi bi-check-lg"></i> Acc
                                        </button>

                                        <button type="button" 
                                                onclick="konfirmasiTolak('{{ route('admin.postingan.tolak', $item->id_item) }}', '{{ $item->nama_barang }}')"
                                                class="bg-rose-500 hover:bg-rose-600 text-white text-[11px] font-bold px-3 py-1.5 rounded-xl transition-all shadow-sm shadow-rose-500/10 cursor-pointer flex items-center gap-1">
                                            <i class="bi bi-x-lg"></i> Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-400 italic py-16 bg-white">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <i class="bi bi-postcard text-4xl text-gray-300"></i>
                                        <span class="text-sm">Belum ada postingan yang masuk di antrean.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // SweetAlert Pop-Up Konfirmasi Persetujuan Postingan (ACC)
        function konfirmasiSetuju(url, namaBarang) {
            Swal.fire({
                title: 'Setujui Postingan?',
                text: `Apakah Anda yakin ingin menyetujui dan menerbitkan postingan "${namaBarang}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#059669', // Emerald Green senada tombol
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[1.5rem]' }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        // SweetAlert Pop-Up Konfirmasi Penolakan Postingan (TOLAK)
        function konfirmasiTolak(url, namaBarang) {
            Swal.fire({
                title: 'Tolak Postingan?',
                text: `Apakah Anda yakin ingin menolak postingan "${namaBarang}" dari antrean publik?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626', // Crimson Rose senada tombol
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[1.5rem]' }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        function liveSearchPosts() {
            const input = document.getElementById("postSearch");
            const filter = input.value.toLowerCase();
            const table = document.querySelector("table tbody");
            const rows = table.getElementsByTagName("tr");
            let activeCount = 0;

            for (let i = 0; i < rows.length; i++) {
                if(rows[i].cells.length < 8) continue; 
                const textContent = rows[i].textContent || rows[i].innerText;
                if (textContent.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                    activeCount++;
                } else {
                    rows[i].style.display = "none";
                }
            }
            document.getElementById("postCount").innerText = activeCount;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const table = document.querySelector("table tbody");
            const rows = table.getElementsByTagName("tr");
            if(rows.length === 1 && rows[0].innerText.includes("Belum ada postingan yang masuk")) {
                document.getElementById("postCount").innerText = 0;
            } else {
                document.getElementById("postCount").innerText = rows.length;
            }
        });
    </script>
</body>
</html>