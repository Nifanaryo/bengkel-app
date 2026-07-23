<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaksi Servis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Pelanggan</label>
                        <select name="customer_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $transaction->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Kendaraan</label>
                        <select name="vehicle_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $transaction->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->plat_nomor }} - {{ $vehicle->merk }} {{ $vehicle->tipe }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Keluhan / Perbaikan</label>
                        <textarea name="keluhan" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('keluhan', $transaction->keluhan) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Total Biaya (Rp)</label>
                        <input type="number" name="biaya_total" value="{{ old('biaya_total', $transaction->biaya_total) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Status Servis</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ $transaction->status == 'proses' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="selesai" {{ $transaction->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('transactions.index') }}" class="text-gray-600 hover:underline text-sm">Kembali</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Update Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>