<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Postingan') }}
            </h2>
            <div class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full font-bold">
                {{ count($semua_barang) }} LAPORAN MASUK
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200 shadow-sm text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama & Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi & Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($semua_barang as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="h-12 w-12 border rounded-lg overflow-hidden bg-gray-50 shadow-sm">
                                            @if($item->foto_barang)
                                                <img class="h-12 w-12 object-cover" src="{{ asset('storage/' . $item->foto_barang) }}">
                                            @else
                                                <div class="h-12 w-12 flex items-center justify-center text-gray-400 text-[10px]">No Photo</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $item->nama_barang }}</div>
                                        <div class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $item->kategori ?? 'Semua' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-xs text-gray-500 truncate w-40" title="{{ $item->deskripsi }}">
                                            {{ $item->deskripsi ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">📍 {{ $item->lokasi }}</div>
                                        <div class="text-[10px] text-gray-500 italic">{{ $item->tanggal_kejadian }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-0.5 inline-flex text-[10px] leading-5 font-bold rounded-full border {{ $item->jenis_barang == 'hilang' ? 'bg-red-50 text-red-700 border-red-200' : 'bg-green-50 text-green-700 border-green-200' }}">
                                            {{ strtoupper($item->jenis_barang) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $st = strtoupper($item->status ?? 'PENDING');
                                            $colorClass = match($st) {
                                                'APPROVED' => 'bg-green-500 text-black', // Approved teks hitam
                                                'REJECTED' => 'bg-red-600 text-white',
                                                'SELESAI'  => 'bg-blue-600 text-white',
                                                default    => 'bg-yellow-300 text-yellow-900',
                                            };
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-[10px] leading-5 font-bold rounded-md shadow-sm {{ $colorClass }}">
                                            {{ $st }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-1">
                                            <a href="{{ route('admin.postingan.terima', $item->id_item) }}" class="px-2 py-1 bg-white border border-green-500 text-green-600 rounded text-[10px] hover:bg-green-50 font-bold transition shadow-sm">Acc</a>
                                            <a href="{{ route('admin.postingan.tolak', $item->id_item) }}" class="px-2 py-1 bg-white border border-red-500 text-red-600 rounded text-[10px] hover:bg-red-50 font-bold transition shadow-sm">Tolak</a>
                                            <a href="{{ route('admin.postingan.selesai', $item->id_item) }}" class="px-2 py-1 bg-indigo-600 text-white rounded text-[10px] hover:bg-indigo-700 font-bold transition shadow-sm">Selesai</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500 italic">
                                        Belum ada laporan masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>