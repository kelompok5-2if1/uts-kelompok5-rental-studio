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
        Schema::create('pembayarans', function (Blueprint $table) {

            $table->id();

            // Jenis transaksi
            $table->enum('jenis_transaksi', [
                'Booking Studio',
                'Rental Alat'
            ]);

            // Relasi Booking Studio
            $table->foreignId('booking_studio_id')
                ->nullable()
                ->constrained('booking_studios')
                ->nullOnDelete();

            // Relasi Rental Alat
            $table->foreignId('rental_alat_id')
                ->nullable()
                ->constrained('rental_alats')
                ->nullOnDelete();

            // Tanggal pembayaran
            $table->date('tanggal_bayar');

            // Metode pembayaran
            $table->enum('metode_bayar', [
                'Cash',
                'Transfer',
                'QRIS',
                'Debit'
            ]);

            // Total tagihan
            $table->decimal('total_bayar', 12, 2);

            // Nominal yang dibayar customer
            $table->decimal('nominal_dibayar', 12, 2);

            // Kembalian
            $table->decimal('kembalian', 12, 2)->default(0);

            // Status pembayaran
            $table->enum('status', [
                'Belum Lunas',
                'Lunas'
            ])->default('Belum Lunas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};