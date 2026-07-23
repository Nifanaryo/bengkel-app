<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Pemilik (Pelanggan)</label>
                        <select name="customer_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $vehicle->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->nama }} ({{ $customer->no_hp }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Plat Nomor</label>
                        <input type="text" name="plat_nomor" value="{{ old('plat_nomor', $vehicle->plat_nomor) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Merk</label>
                        <input type="text" name="merk" value="{{ old('merk', $vehicle->merk) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Tipe / Model</label>
                        <input type="text" name="tipe" value="{{ old('tipe', $vehicle->tipe) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('vehicles.index') }}" class="text-gray-600 hover:underline text-sm">Kembali</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Update Kendaraan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>