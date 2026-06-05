<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_motor_id')
                  ->constrained('jenis_motors')
                  ->onDelete('cascade');
            $table->string('plat_nomor')->unique();
            $table->year('tahun');
            $table->string('warna');
            $table->enum('status', ['tersedia', 'disewa'])->default('tersedia');
            $table->text('catatan')->nullable(); // catatan internal admin saja
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};
