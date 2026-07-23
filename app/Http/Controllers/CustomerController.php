<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Tampilkan daftar pelanggan
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('customers.index', compact('customers'));
    }

    // Tampilkan form tambah pelanggan
    public function create()
    {
        return view('customers.create');
    }

    // Simpan data pelanggan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:100',
            'no_hp'  => 'required|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    // Tampilkan form edit pelanggan
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    // Simpan perubahan data pelanggan
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'nama'   => 'required|string|max:100',
            'no_hp'  => 'required|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil diperbarui');
    }

    // Hapus data pelanggan
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil dihapus');
    }
}