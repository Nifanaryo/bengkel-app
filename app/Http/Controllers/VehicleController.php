<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('customer')->latest()->get();
        $customers = Customer::all();
        return view('vehicles.index', compact('vehicles', 'customers'));
    }

    public function create()
    {
        $customers = Customer::all(); 
        return view('vehicles.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'plat_nomor'  => 'required|string|unique:vehicles,plat_nomor',
            'merk'        => 'required|string',
            'tipe'        => 'required|string',
        ]);

        Vehicle::create($validated);
        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil terdaftar');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $customers = Customer::all();
        return view('vehicles.edit', compact('vehicle', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            // Pengecualian ID sendiri agar plat nomor tidak dianggap duplikat saat di-update
            'plat_nomor'  => 'required|string|unique:vehicles,plat_nomor,' . $id,
            'merk'        => 'required|string',
            'tipe'        => 'required|string',
        ]);

        $vehicle->update($validated);
        return redirect()->route('vehicles.index')->with('success', 'Data kendaraan berhasil diperbarui');
    }

    public function destroy($id)
    {
        Vehicle::findOrFail($id)->delete();
        return redirect()->route('vehicles.index')->with('success', 'Data kendaraan berhasil dihapus');
    }
}