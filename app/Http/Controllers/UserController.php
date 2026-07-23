<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Tampilakan daftar user
    public function index()
    {
        $users = user::latest()->get();
        return view('users.index', compact('users'));
    }
    
    // Tampilkan form tambah user
    public function create()
    {
        return view('users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    // Tampilkan form edit user
    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Simpan perubahan data user
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        // Jika password diisi, enkripsi dan update
        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui');
    }

    // Hapus user
    public function destroy(int $id)
    {
        // Mencegah hapus akun sendiri yang sedang login
        if (auth()->id() == $id) {
            return redirect()->back()->with('error', 'Kamu tidak bisa menghapus akun kamu sendiri yang sedang digunakan!');
        }

        User::findOrFail($id)->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
