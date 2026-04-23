<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Barang Temuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <form action="{{ route('PostBarangTemuan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="item_name" class="block font-medium text-sm text-gray-700">Nama Barang</label>
                        <input type="text" name="item_name" id="item_name" value="{{ old('item_name') }}" placeholder="Misal: Kunci Motor Honda" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 block mt-1 w-full" required>
                        @error('item_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block font-medium text-sm text-gray-700">Lokasi Ditemukan</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Contoh: Kantin Lt. 2" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 block mt-1 w-full" required>
                        @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="found_date" class="block font-medium text-sm text-gray-700">Tanggal Ditemukan</label>
                        <input type="date" name="found_date" id="found_date" value="{{ old('found_date') }}" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 block mt-1 w-full" required>
                        @error('found_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi Barang</label>
                        <textarea name="description" id="description" rows="3" placeholder="Sebutkan ciri-ciri barang secara detail..." class="rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 block mt-1 w-full" required>{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="image" class="block font-medium text-sm text-gray-700">Foto Barang (Opsional)</label>
                        <input type="file" name="image" id="image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                        <p class="mt-1 text-xs text-gray-400 font-italic">*Format: JPG, PNG, JPEG (Max 2MB)</p>
                        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-end border-t pt-4">
                        <a href="{{ route('PostBarangTemuan.index') }}" class="mr-4 text-sm text-gray-600 hover:underline">Batal</a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 shadow-md">
                            {{ __('Posting Sekarang') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>