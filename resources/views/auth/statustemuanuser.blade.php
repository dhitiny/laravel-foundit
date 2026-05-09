<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Barang Temuan</h2>
            <a href="/dashboard" class="px-4 py-2 bg-gray-200 rounded-md text-xs font-bold uppercase tracking-widest hover:bg-gray-300 transition shadow-sm">Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-indigo-100 text-indigo-600 mr-4">🔍</div>
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Total Temuan</p>
                        <h4 class="text-xl font-bold text-gray-800">{{ $semua_barang->count() }}</h4>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-blue-100 text-blue-600 mr-4">✔️</div>
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Approved</p>
                        <h4 class="text-xl font-bold text-gray-800">{{ $semua_barang->where('status', 'APPROVED')->count() }}</h4>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-green-100 text-green-600 mr-4">✅</div>
                    <div>
                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-wider">Selesai</p>
                        <h4 class="text-xl font-bold text-gray-800">{{ $semua_barang->where('status', 'SELESAI')->count() }}</h4>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama & Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi & Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($semua_barang as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    @if($item->foto_barang)
                                        <img src="{{ asset('storage/' . $item->foto_barang) }}" class="h-16 w-16 object-cover rounded-md border shadow-sm">
                                    @else
                                        <div class="h-16 w-16 bg-gray-100 border rounded-md flex items-center justify-center text-[10px] text-gray-400 text-center">No Photo</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-indigo-700">{{ $item->nama_barang }}</div>
                                    <div class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $item->kategori }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs text-gray-600 w-48 break-words line-clamp-2">
                                        {{ $item->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700 font-medium">📍 {{ $item->lokasi }}</div>
                                    <div class="text-xs text-gray-400 mt-1 italic">📅 {{ $item->tanggal_kejadian }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $currentStatus = strtoupper($item->status ?? 'PENDING');
                                        $color = match($currentStatus) {
                                            'APPROVED' => 'bg-green-100 text-green-800 border-green-200',
                                            'REJECTED' => 'bg-red-100 text-red-800 border-red-200',
                                            'SELESAI' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            default => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-bold rounded-full border {{ $color }}">
                                        {{ $currentStatus }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">Belum ada laporan barang temuan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>