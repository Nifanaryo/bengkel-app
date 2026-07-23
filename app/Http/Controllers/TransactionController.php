<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['customer', 'vehicle', 'user'])->latest()->get();
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        return view('transactions.index', compact('transactions', 'customers', 'vehicles'));
    }

    public function create()
    {
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        return view('transactions.index', compact('customers', 'vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id'  => 'required|exists:vehicles,id',
            'keluhan'     => 'required|string',
            'biaya_total' => 'required|numeric',
            'status'      => 'required|in:pending,proses,selesai',
        ]);

        $validated['user_id'] = auth()->user()->id;
        $validated['tanggal'] = now();

        Transaction::create($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaksi servis berhasil disimpan');
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        return view('transactions.edit', compact('transaction', 'customers', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id'  => 'required|exists:vehicles,id',
            'keluhan'     => 'required|string',
            'biaya_total' => 'required|numeric',
            'status'      => 'required|in:pending,proses,selesai',
        ]);

        $transaction->update($validated);
        return redirect()->route('transactions.index')->with('success', 'Transaksi servis berhasil diperbarui');
    }

    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        return redirect()->route('transactions.index')->with('success', 'Data transaksi berhasil dihapus');
    }
}