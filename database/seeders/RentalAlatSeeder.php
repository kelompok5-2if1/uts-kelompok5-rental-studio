<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RentalAlat;

class RentalAlatSeeder extends Seeder
{
    public function run(): void
    {
        RentalAlat::insert([
            [
                'pelanggan_id'=>1,
                'alat_band_id'=>1,
                'tanggal_sewa'=>'2026-07-01',
                'tanggal_kembali'=>'2026-07-03',
                'jumlah'=>2,
                'total_harga'=>60000,
                'status'=>'Dipinjam'
            ],

            [
                'pelanggan_id'=>2,
                'alat_band_id'=>3,
                'tanggal_sewa'=>'2026-07-02',
                'tanggal_kembali'=>'2026-07-04',
                'jumlah'=>1,
                'total_harga'=>100000,
                'status'=>'Dikembalikan'
            ],
        ]);
    }
}