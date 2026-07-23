<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Transaksi Servis') }}
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Form Tambah Transaksi -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 h-fit">
                    <h3 class="text-lg font-bold mb-4 text-gray-700">Catat Transaksi Baru</h3>
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Pelanggan</label>
                            <select name="customer_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Kendaraan</label>
                            <select name="vehicle_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">-- Pilih Kendaraan --</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->plat_nomor }} - {{ $vehicle->merk }} {{ $vehicle->tipe }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Keluhan / Perbaikan</label>
                            <textarea name="keluhan" rows="3" placeholder="Contoh: Ganti oli, rem berbunyi" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Total Biaya (Rp)</label>
                            <input type="number" name="biaya_total" placeholder="150000" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Status Servis</label>
                            <select name="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="pending">Pending</option>
                                <option value="proses">Dalam Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Simpan Transaksi
                        </button>
                    </form>
                </div>

                <!-- Tabel Daftar Transaksi -->
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm border border-gray-200 overflow-x-auto">
                    <h3 class="text-lg font-bold mb-4 text-gray-700">Riwayat Servis</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50 text-xs font-semibold text-gray-600 uppercase">
                                <th class="p-3">#</th>
                                <th class="p-3">Pelanggan / Plat</th>
                                <th class="p-3">Keluhan</th>
                                <th class="p-3">Biaya</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @forelse($transactions as $transaction)
                            <tr>
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">
                                    <div class="font-bold text-gray-900">{{ $transaction->customer->nama ?? '-' }}</div>
                                    <div class="text-xs text-gray-500">{{ $transaction->vehicle->plat_nomor ?? '-' }}</div>
                                </td>
                                <td class="p-3 text-gray-700">{{ $transaction->keluhan }}</td>
                                <td class="p-3 font-semibold text-gray-900">Rp {{ number_format($transaction->biaya_total, 0, ',', '.') }}</td>
                                <td class="p-3">
                                    @if($transaction->status == 'pending')
                                        <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-0.5 rounded">Pending</span>
                                    @elseif($transaction->status == 'proses')
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Proses</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Selesai</span>
                                    @endif
                                </td>
                                <td class="p-3 flex space-x-2">
                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="text-amber-600 hover:text-amber-900 font-medium">Edit</a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-500">Belum ada data transaksi servis.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>