<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data User / Mekanik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Form Tambah User -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 h-fit">
                    <h3 class="text-lg font-bold mb-4 text-gray-700">Tambah User Baru</h3>
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Password</label>
                            <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Simpan User
                        </button>
                    </form>
                </div>

                <!-- Tabel Daftar User -->
                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-sm border border-gray-200 overflow-x-auto">
                    <h3 class="text-lg font-bold mb-4 text-gray-700">Daftar Pengguna / Mekanik</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                                <th class="p-3">#</th>
                                <th class="p-3">Nama</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @forelse($users as $user)
                            <tr>
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3 font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="p-3">{{ $user->email }}</td>
                                <td class="p-3 flex space-x-2">
                                    <a href="{{ route('users.edit', $user->id) }}" class="text-amber-600 hover:text-amber-900 font-medium">Edit</a>
                                    @if(auth()->id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">Belum ada data user.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>