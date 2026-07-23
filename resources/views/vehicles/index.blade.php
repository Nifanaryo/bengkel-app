<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Form Tambah Kendaraan -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 h-fit">
                    <h3 class="text-lg font-bold mb-4 text-gray-700">Tambah Kendaraan Baru</h3>
                    <form action="{{ route('vehicles.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Pemilik (Pelanggan)</label>
                            <select name="customer_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->nama }} ({{ $customer->no_hp }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Plat Nomor</label>
                            <input type="text" name="plat_nomor" placeholder="Contoh: B 1234 ABC" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Merk (Brand)</label>
                            <input type="text" name="merk" placeholder="Contoh: Honda, Toyota, Yamaha" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Tipe / Model</label>
                            <input type="text" name="tipe" placeholder="Contoh: Vario 150, Avanza" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Simpan Kendaraan
                        </button>
                    </form>
                </div>

                <!-- Tabel Daftar Kendaraan -->
                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-sm border border-gray-200 overflow-x-auto">
                    <h3 class="text-lg font-bold mb-4 text-gray-700">Daftar Kendaraan Terdaftar</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                                <th class="p-3">#</th>
                                <th class="p-3">Plat Nomor</th>
                                <th class="p-3">Merk & Tipe</th>
                                <th class="p-3">Pemilik</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @forelse($vehicles as $vehicle)
                            <tr>
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3 font-bold text-gray-900">{{ $vehicle->plat_nomor }}</td>
                                <td class="p-3">{{ $vehicle->merk }} - {{ $vehicle->tipe }}</td>
                                <td class="p-3 font-medium text-indigo-600">{{ $vehicle->customer->nama ?? '-' }}</td>
                                <td class="p-3 flex space-x-2">
                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="text-amber-600 hover:text-amber-900 font-medium">Edit</a>
                                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data kendaraan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data kendaraan terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>