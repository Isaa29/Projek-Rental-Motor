<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_motors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jenis');
            $table->string('merk');
            $table->string('tipe');
            $table->integer('harga_sewa');
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_motors');
    }
};
