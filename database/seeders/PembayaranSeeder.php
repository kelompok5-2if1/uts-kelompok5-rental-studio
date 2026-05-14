<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        Pembayaran::create([
            'rental_alat_id' => 1,
            'tanggal_bayar' => '2026-05-14',
            'metode_bayar' => 'Transfer',
            'total_bayar' => 140000,
            'status' => 'Lunas'
        ]);

        Pembayaran::create([
            'rental_alat_id' => 2,
            'tanggal_bayar' => '2026-05-15',
            'metode_bayar' => 'Cash',
            'total_bayar' => 120000,
            'status' => 'Belum Lunas'
        ]);
    }
}