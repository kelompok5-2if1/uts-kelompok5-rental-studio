<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alat_bands', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('kategori_alat_id');

            $table->foreign('kategori_alat_id')
                ->references('id')
                ->on('kategoris')
                ->onDelete('cascade');
                
            $table->string('nama_alat');

            $table->integer('stok');

            $table->integer('harga_sewa');

            $table->string('kondisi');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alat_bands');
    }
};