<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - FoundIt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Memaksa semua elemen tanpa terkecuali menggunakan Poppins */
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
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-semibold text-white bg-[#C11720] shadow-md shadow-[#C11720]/20 mb-2">
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
                    <i class="bi bi-person-x-fill text-2xl text-[#0C324A]"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-[#0C324A] tracking-tight">
                        Selamat Datang, Admin '{{ Auth::user()->username ?? 'Super' }}'
                    </h2>
                    <p class="text-xs text-gray-400 mt-0.5">Pantau status keamanan akun dan batasi hak akses pengguna secara real-time</p>
                </div>
            </div>
            <span class="bg-[#041942] text-white text-xs font-bold px-4 py-2 rounded-full shadow-sm tracking-wider">
                {{ count($users) }} PENGGUNA TERDAFTAR
            </span>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl shadow-sm flex items-center space-x-3" role="alert">
                <i class="bi bi-check-circle-fill text-xl text-emerald-500"></i>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 justify-between items-center">
            <div class="relative w-full md:w-[480px]">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                    <i class="bi bi-search text-sm"></i>
                </span>
                <input type="text" id="userSearch" onkeyup="liveSearchUsers()" 
                       class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 text-sm rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0C324A]/20 focus:border-[#0C324A] transition-all font-medium placeholder-gray-400 text-gray-700" 
                       placeholder="Cari username, email, atau status aktif...">
            </div>
            
            <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                <span class="text-xs text-gray-400 font-semibold bg-gray-50 px-3 py-2 rounded-xl border border-gray-100">
                    <i class="bi bi-filter-left text-[#0C324A] mr-1 text-sm"></i> Terfilter: <span id="userCount" class="font-bold text-[#0C324A]">0</span> pengguna
                </span>
            </div>
        </div>

        <div class="flex items-center gap-2 pt-2 px-1">
            <i class="bi bi-people-fill text-[#041942] text-lg"></i>
            <h3 class="text-base font-bold text-[#041942] tracking-tight">Daftar Anggota Komunitas</h3>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-fixed min-w-[900px]">
                    <thead>
                        <tr class="bg-[#041942] text-white text-xs font-semibold tracking-wide uppercase">
                            <th class="py-4.5 pl-6 w-[25%]">Username</th>
                            <th class="py-4.5 w-[30%]">Alamat Email</th>
                            <th class="py-4.5 w-[18%]">Tanggal Bergabung</th>
                            <th class="py-4.5 w-[12%]">Status Sekarang</th>
                            <th class="py-4.5 pr-6 text-center w-[15%]">Aksi Pengubahan Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100 bg-white text-gray-600">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50/40 transition-all">
                                <td class="py-4 pl-6">
                                    <div class="font-bold text-[#041942] truncate">{{ $user->username }}</div>
                                    <div class="text-[10px] font-mono text-gray-400 mt-0.5">UID: #{{ $user->id_user }}</div>
                                </td>
                                <td class="py-4 pr-4">
                                    <div class="text-gray-500 truncate" title="{{ $user->email }}">{{ $user->email }}</div>
                                </td>
                                <td class="py-4 text-gray-500 font-medium">
                                    <i class="bi bi-calendar3 text-gray-400 mr-1.5 text-xs"></i> 
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="py-4">
                                    @php
                                        $statusUser = strtolower(trim($user->status ?? 'aktif'));
                                        $statusBadgeClass = match($statusUser) {
                                            'aktif' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'banned' => 'bg-rose-50 text-rose-700 border-rose-200',
                                            default => 'bg-amber-50 text-amber-700 border-amber-200',
                                        };
                                    @endphp
                                    <span class="text-[9px] font-bold px-2.5 py-1 rounded border uppercase {{ $statusBadgeClass }}">
                                        {{ $statusUser }}
                                    </span>
                                </td>
                                <td class="py-4 pr-6 text-center">
                                    <form action="{{ route('admin.users.updateStatus', $user->id_user) }}" method="POST" 
                                          onsubmit="return konfirmasiUpdateStatus(event, '{{ $user->username }}')" 
                                          class="inline-flex items-center gap-1.5 justify-center">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <select name="status" class="text-xs font-bold text-gray-600 rounded-xl border border-gray-200 px-2 py-1.5 focus:outline-none focus:border-[#0C324A] bg-gray-50/50 shadow-sm transition-all">
                                            <option value="aktif" {{ $user->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="non-aktif" {{ $user->status == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                            <option value="banned" {{ $user->status == 'banned' ? 'selected' : '' }}>Banned</option>
                                        </select>
                                        
                                        <button type="submit" class="bg-[#041942] text-white font-bold text-[11px] px-2.5 py-1.5 rounded-xl hover:bg-[#061e2e] transition-all flex items-center gap-1 shadow-sm cursor-pointer">
                                            <i class="bi bi-floppy"></i> Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-400 italic py-16">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <i class="bi bi-people text-4xl text-gray-300"></i>
                                        <span class="text-sm">Tidak ada data pengguna terdaftar.</span>
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
        // Fungsi Pop-Up Konfirmasi Sebelum Menyimpan Perubahan Status User
        function konfirmasiUpdateStatus(event, username) {
            event.preventDefault(); // Menghentikan form agar tidak langsung terkirim
            const form = event.target;

            Swal.fire({
                title: 'Perbarui Status Pengguna?',
                text: `Apakah Anda yakin ingin menyimpan perubahan status untuk user "${username}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#041942', // Warna navy senada
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Perbarui!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-[1.5rem]' }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Mengirimkan form jika admin klik tombol 'Ya'
                }
            });
            return false;
        }

        function liveSearchUsers() {
            const input = document.getElementById("userSearch");
            const filter = input.value.toLowerCase();
            const table = document.querySelector("table tbody");
            const rows = table.getElementsByTagName("tr");
            let activeCount = 0;
            let isCurrentEmpty = false;

            if(rows.length === 1 && rows[0].innerText.includes("Tidak ada data pengguna")) {
                isCurrentEmpty = true;
            }

            if (!isCurrentEmpty) {
                for (let i = 0; i < rows.length; i++) {
                    const textContent = rows[i].textContent || rows[i].innerText;
                    if (textContent.toLowerCase().indexOf(filter) > -1) {
                        rows[i].style.display = "";
                        activeCount++;
                    } else {
                        rows[i].style.display = "none";
                    }
                }
                document.getElementById("userCount").innerText = activeCount;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const table = document.querySelector("table tbody");
            const rows = table.getElementsByTagName("tr");
            if(rows.length === 1 && rows[0].innerText.includes("Tidak ada data pengguna")) {
                document.getElementById("userCount").innerText = 0;
            } else {
                document.getElementById("userCount").innerText = rows.length;
            }
        });

    </script>
</body>
</html>