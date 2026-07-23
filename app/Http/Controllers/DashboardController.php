<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Transaction; 
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan statistik utama pada Halaman Dashboard
     */
    public function index()
    {
        // Menghitung total data dari masing-masing tabel
        $totalCustomer     = Customer::count();
        $totalVehicle      = Vehicle::count();
        $totalTransaction  = Transaction::count();
        $pendingTransaction = Transaction::where('status', 'pending')->count();

        // Mengirimkan data variabel ke view 'dashboard'
        return view('dashboard', compact(
            'totalCustomer',
            'totalVehicle',
            'totalTransaction',
            'pendingTransaction'
        ));
    }
}