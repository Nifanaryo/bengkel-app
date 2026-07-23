<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Bengkel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Card Pelanggan -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm font-medium text-gray-500">Total Pelanggan</p>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalCustomer }}</p>
                </div>

                <!-- Card Kendaraan -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm font-medium text-gray-500">Total Kendaraan</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalVehicle }}</p>
                </div>

                <!-- Card Total Transaksi -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm font-medium text-gray-500">Total Transaksi</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalTransaction }}</p>
                </div>

                <!-- Card Servis Pending -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-sm font-medium text-gray-500">Servis Pending</p>
                    <p class="text-3xl font-bold text-amber-600 mt-2">{{ $pendingTransaction }}</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
