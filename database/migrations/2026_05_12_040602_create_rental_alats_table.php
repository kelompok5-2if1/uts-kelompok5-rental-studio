<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_alats', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pelanggan_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('alat_band_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->date('tanggal_sewa');

            $table->date('tanggal_kembali');

            $table->integer('jumlah');

            $table->integer('total_harga');

            $table->enum('status', [
                'Dipinjam',
                'Dikembalikan'
            ]);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_alats');
    }
};