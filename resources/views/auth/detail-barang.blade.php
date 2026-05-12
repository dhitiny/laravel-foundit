<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tombol Kembali Ke Dashboard -->
            <div class="mb-4">
               <a href="{{ route('homepage') }}" class="text-gray-500 hover:text-gray-700 flex items-center text-sm font-medium transition duration-200">
    <i class="bi bi-arrow-left mr-2"></i> Kembali
</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100">
                <div class="md:flex">
                    
                    <!-- SISI KIRI: GAMBAR (Ratio 1:1) -->
                    <div class="md:w-1/2 relative bg-gray-200">
                        @if($item->foto_barang)
                            <img src="{{ asset('storage/' . $item->foto_barang) }}" class="w-full h-full object-cover min-h-[450px]">
                        @else
                            <div class="w-full h-full flex items-center justify-center min-h-[450px] bg-gray-100 text-gray-300">
                                <div class="text-center">
                                    <i class="bi bi-image" style="font-size: 5rem;"></i>
                                    <p class="text-xs mt-2 italic font-medium">Foto Tidak Tersedia</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Badge Jenis Barang (Hilang/Temuan) -->
                        <div class="absolute top-6 left-6">
                            <span class="px-4 py-1.5 rounded-xl text-[10px] font-black tracking-widest uppercase shadow-lg {{ $item->jenis_barang == 'hilang' ? 'bg-[#f25e0d] text-white' : 'bg-blue-600 text-white' }}">
                                BARANG {{ $item->jenis_barang }}
                            </span>
                        </div>
                    </div>

                    <!-- SISI KANAN: DETAIL INFORMASI -->
                    <div class="md:w-1/2 p-10 flex flex-col justify-between bg-white">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-1 tracking-tight">
                                {{ $item->nama_barang }}
                            </h1>
                            <p class="text-xs text-gray-400 font-medium mb-8 uppercase tracking-wider">
                                ID: #FND-{{ $item->id_item }}
                            </p>

                            <!-- Bagian Deskripsi -->
                            <div class="mb-8">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-3 block">Deskripsi</label>
                                <div class="bg-blue-50/30 border-l-4 border-[#f25e0d] p-4 rounded-r-2xl">
                                    <p class="text-gray-600 text-sm leading-relaxed italic">
                                        "{{ $item->deskripsi ?? 'Tidak ada deskripsi tambahan untuk barang ini.' }}"
                                    </p>
                                </div>
                            </div>

                            <!-- Grid Info Lokasi & Tanggal -->
                            <div class="grid grid-cols-2 gap-4 mb-10">
                                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                    <label class="text-[9px] font-bold text-gray-400 uppercase mb-1 block tracking-wider">Lokasi</label>
                                    <p class="text-gray-800 text-sm font-bold flex items-center">
                                        <i class="bi bi-geo-alt-fill text-[#f25e0d] mr-2"></i> {{ $item->lokasi }}
                                    </p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                    <label class="text-[9px] font-bold text-gray-400 uppercase mb-1 block tracking-wider">Dilaporkan</label>
                                    <p class="text-gray-800 text-sm font-bold flex items-center">
                                        <i class="bi bi-calendar3 text-[#f25e0d] mr-2"></i> 
                                        {{ date('d M Y', strtotime($item->tanggal_kejadian)) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian Action Buttons -->
                        <div>
                            <button class="w-full bg-[#f25e0d] hover:bg-[#d44d08] text-white font-bold py-4 rounded-2xl shadow-lg shadow-orange-100 transition duration-300 flex items-center justify-center uppercase tracking-[0.1em] text-sm">
                                <i class="bi bi-check-circle-fill mr-2 text-lg"></i> Klaim Barang 
                            </button>

                            <!-- Alert Penting -->
                            <div class="mt-5 bg-orange-50 border border-orange-100 rounded-2xl p-4 flex items-start">
                                <i class="bi bi-exclamation-triangle-fill text-orange-400 mt-0.5 mr-3 text-lg"></i>
                                <p class="text-[11px] text-orange-800 leading-relaxed font-medium">
                                    <span class="font-bold">Penting:</span>Harap siapkan bukti foto atau informasi detail barang untuk keperluan verifikasi saat proses pengambilan.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- Footer Kecil -->
            <div class="mt-8 text-center">
                <p class="text-[10px] text-gray-400 font-medium tracking-widest uppercase">
                    &copy; 2026 FoundIt - The Founder 
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</x-app-layout>