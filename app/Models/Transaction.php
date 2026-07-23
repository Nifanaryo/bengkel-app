<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Transaksi diproses oleh satu Mekanik/Admin (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Transaksi milik satu Pelanggan
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Transaksi untuk satu Kendaraan
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}