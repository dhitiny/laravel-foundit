<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Barang Temuan - FoundIt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fdfbf7; }
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
            
            <a href="{{ route('admin.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-postcard-heart-fill text-lg"></i> Manajemen Postingan
            </a>

            <a href="#" onclick="openModalKategori()" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-tags-fill text-lg text-amber-400"></i> Master Kategori
            </a>

            <a href="{{ route('admin.badge.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-award-fill text-lg text-emerald-400"></i> Master Badge User
            </a>
            
            <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider block mt-6 mb-3 px-2">Menu Monitoring</span>
            
            <a href="{{ route('admin.monitoring.hilang') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all mb-2">
                <i class="bi bi-search-heart text-lg"></i> Monitor Barang Hilang
            </a>
            
            <a href="{{ route('admin.monitoring.temuan') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold text-white bg-[#C11720] shadow-md shadow-[#C11720]/20 mb-2">
                <i class="bi bi-box-seam-fill text-lg text-white"></i> Monitor Barang Temuan
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

    <div class="ml-[260px] p-8 max-w-[1600px] mx-auto space-y-6">
        
        <div class="flex justify-between items-center pb-4 border-b-2 border-[#0C324A]/5">
            <div class="flex items-center space-x-3">
                <div class="bg-indigo-500/10 p-2.5 rounded-2xl">
                    <i class="bi bi-box-seam-fill text-2xl text-indigo-600"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-[#0C324A] tracking-tight">Monitoring Laporan Barang Temuan</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Pantau status publikasi barang temuan yang dilaporkan oleh para penemu jujur</p>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-[#0C324A] rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-sm">
                Dashboard Admin
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4">
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-3">
                <div class="p-3 rounded-xl bg-indigo-50 text-indigo-600 border border-indigo-100 text-lg">
                    <i class="bi bi-archive-fill"></i>
                </div>
                <div>
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Total Laporan</p>
                    <h4 class="text-xl font-extrabold text-[#0C324A] mt-0.5">{{ $semua_barang->count() }}</h4>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-3">
                <div class="p-3 rounded-xl bg-amber-50 text-amber-600 border border-amber-100 text-lg">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Laporan Pending</p>
                    <h4 class="text-xl font-extrabold text-[#0C324A] mt-0.5">
                        {{ $semua_barang->filter(fn($b) => in_array(strtoupper($b->status), [null, '', 'PENDING']))->count() }}
                    </h4>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-3">
                <div class="p-3 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100 text-lg">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Laporan Approved</p>
                    <h4 class="text-xl font-extrabold text-[#0C324A] mt-0.5">
                        {{ $semua_barang->filter(fn($b) => strtoupper($b->status) === 'APPROVED')->count() }}
                    </h4>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-3">
                <div class="p-3 rounded-xl bg-sky-50 text-sky-600 border border-sky-100 text-lg">
                    <i class="bi bi-flag-fill"></i>
                </div>
                <div>
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Laporan Selesai</p>
                    <h4 class="text-xl font-extrabold text-[#0C324A] mt-0.5">
                        {{ $semua_barang->filter(fn($b) => strtoupper($b->status) === 'SELESAI')->count() }}
                    </h4>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-3">
                <div class="p-3 rounded-xl bg-rose-50 text-rose-500 border border-rose-100 text-lg">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <div>
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-wider">Laporan Rejected</p>
                    <h4 class="text-xl font-extrabold text-[#0C324A] mt-0.5">
                        {{ $semua_barang->filter(fn($b) => strtoupper($b->status) === 'REJECTED')->count() }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 justify-between items-center">
            <div class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="tableSearch" onkeyup="liveSearchTable()" 
                       class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 text-sm rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0C324A]/20 focus:border-[#0C324A] transition-all" 
                       placeholder="Cari nama barang, penemu, lokasi...">
            </div>
            <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                <span class="text-xs text-gray-400 font-medium"><i class="bi bi-info-circle"></i> Menampilkan <span id="rowCount" class="font-bold text-[#0C324A]">0</span> data</span>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-fixed min-w-[1100px]">
                    <thead>
                        <tr class="bg-[#0C324A] text-white text-[11px] font-bold uppercase tracking-wider">
                            <th class="py-4 pl-6 w-[8%]">Foto</th>
                            <th class="py-4 w-[16%]">Penemu</th>
                            <th class="py-4 w-[18%]">Nama Barang</th>
                            <th class="py-4 w-[12%]">Kategori</th>
                            <th class="py-4 w-[24%]">Deskripsi</th>
                            <th class="py-4 w-[12%]">Lokasi & Waktu Ditemukan</th>
                            <th class="py-4 pr-6 w-[10%] text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-50 text-gray-600">
                        @forelse($semua_barang as $item)
                            <tr class="hover:bg-gray-50/40 transition-all">
                                <td class="py-4 pl-6">
                                    @if($item->foto_barang)
                                        <img src="{{ asset('storage/' . $item->foto_barang) }}" class="w-12 h-12 object-cover rounded-xl shadow-sm border border-gray-100" alt="Foto">
                                    @else
                                        <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400 border border-gray-100 text-[10px] font-bold">NO PHOTO</div>
                                    @endif
                                </td>
                                <td class="py-4 pr-2">
                                    <div class="font-semibold text-[#0C324A] truncate">{{ $item->user->username ?? 'User Kosong' }}</div>
                                    <div class="text-[10px] font-mono text-gray-400 mt-0.5">ID: #{{ $item->id_user ?? '-' }}</div>
                                </td>
                                <td class="py-4 pr-2">
                                    <div class="font-bold text-gray-900 truncate" title="{{ $item->nama_barang }}">{{ $item->nama_barang }}</div>
                                </td>
                                <td class="py-4">
                                    <span class="bg-gray-100 text-gray-600 text-[9px] font-extrabold px-2 py-1 rounded border border-gray-200/50 uppercase tracking-wide">
                                        {{ $item->kategori ?? 'LAINNYA' }}
                                    </span>
                                </td>
                                <td class="py-4 pr-4">
                                    <p class="text-gray-500 text-xs line-clamp-2 leading-relaxed" title="{{ $item->deskripsi }}">
                                        {{ $item->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </p>
                                </td>
                                <td class="py-4 pr-2">
                                    <div class="font-medium text-gray-800 truncate">📍 {{ $item->lokasi }}</div>
                                    <div class="text-[10px] text-gray-400 mt-1 italic">📅 {{ $item->tanggal_kejadian }}</div>
                                </td>
                                <td class="py-4 pr-6 text-center">
                                    @php
                                        $currentStatus = strtoupper($item->status ?? 'PENDING');
                                        $color = match($currentStatus) {
                                            'APPROVED' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'REJECTED' => 'bg-rose-50 text-rose-700 border-rose-200',
                                            'SELESAI' => 'bg-sky-50 text-sky-700 border-sky-200',
                                            default => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                        };
                                    @endphp
                                    <span class="text-[9px] font-bold px-2.5 py-1 rounded border uppercase inline-block {{ $color }}">
                                        {{ $currentStatus }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-gray-400 italic py-16">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <i class="bi bi-inbox text-4xl text-gray-300"></i>
                                        <span class="text-sm">Belum ada laporan barang temuan masuk.</span>
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

        function liveSearchTable() {
            const input = document.getElementById("tableSearch");
            const filter = input.value.toLowerCase();
            const table = document.querySelector("table tbody");
            const rows = table.getElementsByTagName("tr");
            let activeRowsCount = 0;
            let isCurrentEmpty = false;

            if(rows.length === 1 && rows[0].innerText.includes("Belum ada laporan")) {
                isCurrentEmpty = true;
            }

            if (!isCurrentEmpty) {
                for (let i = 0; i < rows.length; i++) {
                    const textContent = rows[i].textContent || rows[i].innerText;
                    if (textContent.toLowerCase().indexOf(filter) > -1) {
                        rows[i].style.display = "";
                        activeRowsCount++;
                    } else {
                        rows[i].style.display = "none";
                    }
                }
                document.getElementById("rowCount").innerText = activeRowsCount;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const table = document.querySelector("table tbody");
            const rows = table.getElementsByTagName("tr");
            if(rows.length === 1 && rows[0].innerText.includes("Belum ada laporan")) {
                document.getElementById("rowCount").innerText = 0;
            } else {
                document.getElementById("rowCount").innerText = rows.length;
            }
        });
    </script>
</body>
</html>