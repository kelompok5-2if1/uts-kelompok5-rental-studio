<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailRental;

class DetailRentalSeeder extends Seeder
{
    public function run(): void
    {
        DetailRental::create([
            'rental_alat_id' => 1,
            'alat_band_id' => 1,
            'jumlah' => 2,
            'durasi' => 2,
            'subtotal' => 60000
        ]);

        DetailRental::create([
            'rental_alat_id' => 2,
            'alat_band_id' => 2,
            'jumlah' => 1,
            'durasi' => 3,
            'subtotal' => 80000
        ]);
    }
}