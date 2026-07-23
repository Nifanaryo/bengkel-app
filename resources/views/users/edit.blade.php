<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Password Baru <span class="text-xs text-gray-500">(Kosongkan jika tidak ingin diubah)</span></label>
                        <input type="password" name="password" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('users.index') }}" class="text-gray-600 hover:underline text-sm">Kembali</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>