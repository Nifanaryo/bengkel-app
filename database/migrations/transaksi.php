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
        // Mengubah nama tabel menjadi 'transaksi' dan membuat kolomnya
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained('kendaraan')->onDelete('cascade');
            $table->foreignId('mekanik_id')->constrained('mekanik')->onDelete('cascade');
            $table->date('tanggal_servis');
            $table->integer('total_biaya')->nullable();
            $table->string('status')->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Bagian ini juga diubah menjadi 'transaksi'
        Schema::dropIfExists('transaksi');
    }
};