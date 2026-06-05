<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('jenis_motor_id')
                  ->constrained('jenis_motors')
                  ->onDelete('cascade');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->integer('total_harga');
            $table->enum('metode_bayar', [
                'transfer_mandiri',
                'transfer_bri',
                'tunai'
            ])->default('tunai');
            $table->string('bukti_bayar')->nullable();
            $table->enum('status_bayar', [
                'menunggu',
                'lunas',
                'gagal'
            ])->default('menunggu');
            $table->enum('status', [
                'pending',
                'aktif',
                'selesai',
                'dibatalkan'
            ])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
