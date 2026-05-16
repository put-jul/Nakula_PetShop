<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groomings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('nama_hewan');
            $table->string('jenis_hewan'); // Kucing, Anjing, dll
            $table->string('paket'); // Mandi Biasa, Mandi Kutu, dll
            $table->integer('harga');
            $table->string('status')->default('Antre'); // Antre, Selesai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groomings');
    }
};