<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaporanRental;

class LaporanRentalSeeder extends Seeder
{
    public function run(): void
    {
        LaporanRental::create([
            'tanggal_laporan' => '2026-05-14',
            'total_transaksi' => 5,
            'total_pendapatan' => 500000,
            'keterangan' => 'Pendapatan akhir pekan'
        ]);

        LaporanRental::create([
            'tanggal_laporan' => '2026-05-15',
            'total_transaksi' => 3,
            'total_pendapatan' => 300000,
            'keterangan' => 'Pendapatan hari kerja'
        ]);
    }
}