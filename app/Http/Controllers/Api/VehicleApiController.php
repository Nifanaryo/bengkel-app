<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleApiController extends Controller
{
    // GET: Ambil semua data kendaraan
    public function index()
    {
        $vehicles = Vehicle::with('customer')->latest()->get();
        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Kendaraan',
            'data'    => $vehicles
        ], 200);
    }

    // POST: Tambah data kendaraan baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'  => 'required',
            'plate_number' => 'required|unique:vehicles',
            'brand'        => 'required',
            'type'         => 'required',
        ]);

        $vehicle = Vehicle::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan Berhasil Ditambahkan',
            'data'    => $vehicle
        ], 201);
    }

    // GET: Ambil 1 data kendaraan spesifik
    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $vehicle
        ], 200);
    }

    // PUT/PATCH: Update data kendaraan
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $vehicle->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Kendaraan Berhasil Diperbarui',
            'data'    => $vehicle
        ], 200);
    }

    // DELETE: Hapus kendaraan
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $vehicle->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Kendaraan Berhasil Dihapus'
        ], 200);
    }
}