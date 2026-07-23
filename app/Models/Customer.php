<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Satu pelanggan bisa punya banyak kendaraan
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    // Satu pelanggan bisa punya banyak riwayat transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}