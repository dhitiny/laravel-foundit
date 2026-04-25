<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Barang Hilang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <form action="{{ route('PostBarangHilang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="item_name" class="block font-medium text-sm text-gray-700">Nama Barang Hilang</label>
                        <input type="text" name="item_name" id="item_name" value="{{ old('item_name') }}" placeholder="Misal: Dompet Kulit Cokelat" class="rounded-md shadow-sm border-gray-300 focus:border-red-500 focus:ring-red-500 block mt-1 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block font-medium text-sm text-gray-700">Lokasi Terakhir Terlihat</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Contoh: Parkiran Motor Belakang" class="rounded-md shadow-sm border-gray-300 focus:border-red-500 focus:ring-red-500 block mt-1 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="lost_date" class="block font-medium text-sm text-gray-700">Tanggal Hilang</label>
                        <input type="date" name="lost_date" id="lost_date" value="{{ old('lost_date') }}" class="rounded-md shadow-sm border-gray-300 focus:border-red-500 focus:ring-red-500 block mt-1 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi Ciri-ciri</label>
                        <textarea name="description" id="description" rows="3" placeholder="Sebutkan ciri unik, isi dompet, atau tanda khusus..." class="rounded-md shadow-sm border-gray-300 focus:border-red-500 focus:ring-red-500 block mt-1 w-full" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="image" class="block font-medium text-sm text-gray-700">Foto Barang (Jika Ada)</label>
                        <input type="file" name="image" id="image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition">
                    </div>

                    <div class="flex items-center justify-end border-t pt-4">
                        <a href="{{ route('PostBarangHilang.index') }}" class="mr-4 text-sm text-gray-600 hover:underline">Batal</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition shadow-md">
                            {{ __('Laporkan Kehilangan') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>