<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Bagian ini mengubah nama tabel menjadi 'kendaraan' dan menambahkan kolom-kolomnya
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('cascade');
            $table->string('nomor_polisi');
            $table->string('merk');
            $table->string('keluhan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Bagian ini juga harus diubah menjadi 'kendaraan'
        Schema::dropIfExists('kendaraan');
    }
};