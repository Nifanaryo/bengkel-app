<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $customer->nama) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">No HP / WA</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $customer->no_hp) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('alamat', $customer->alamat) }}</textarea>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('customers.index') }}" class="text-gray-600 hover:underline text-sm">Kembali</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Update Pelanggan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>