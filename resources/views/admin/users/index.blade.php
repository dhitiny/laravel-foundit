<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left text-sm uppercase font-semibold text-gray-600">
                                <th class="px-6 py-3 border-b">Username</th>
                                <th class="px-6 py-3 border-b">Email</th>
                                <th class="px-6 py-3 border-b">Tanggal Bergabung</th>
                                <th class="px-6 py-3 border-b">Status Sekarang</th>
                                <th class="px-6 py-3 border-b text-center">Ubah Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 border-b">{{ $user->username }}</td>
                                <td class="px-6 py-4 border-b">{{ $user->email }}</td>
                                <td class="px-6 py-4 border-b">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 border-b">
                                    <span class="px-2 py-1 rounded text-xs font-bold 
                                        {{ $user->status == 'aktif' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $user->status == 'non-aktif' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $user->status == 'banned' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ strtoupper($user->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 border-b text-center">
                                    <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST" class="inline-flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <select name="status" class="text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="aktif" {{ $user->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="non-aktif" {{ $user->status == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                            <option value="banned" {{ $user->status == 'banned' ? 'selected' : '' }}>Banned</option>
                                        </select>
                                        
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs transition">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($users->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Belum ada user yang terdaftar.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>