<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RentalAlat;

class RentalAlatSeeder extends Seeder
{
    public function run(): void
    {
        RentalAlat::create([
            'pelanggan_id' => 1,
            'alat_band_id' => 1,
            'tanggal_sewa' => '2026-05-14',
            'tanggal_kembali' => '2026-05-16',
            'jumlah' => 2,
            'total_harga' => 120000,
            'status' => 'Dipinjam'
        ]);

        RentalAlat::create([
            'pelanggan_id' => 2,
            'alat_band_id' => 2,
            'tanggal_sewa' => '2026-05-15',
            'tanggal_kembali' => '2026-05-17',
            'jumlah' => 1,
            'total_harga' => 80000,
            'status' => 'Dikembalikan'
        ]);
    }
}