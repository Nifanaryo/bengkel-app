<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Kendaraan ini milik satu pelanggan
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Satu kendaraan bisa punya banyak riwayat servis/transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}