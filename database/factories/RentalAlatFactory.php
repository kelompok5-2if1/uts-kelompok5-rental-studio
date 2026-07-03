<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use App\Models\AlatBand;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalAlatFactory extends Factory
{
    public function definition(): array
    {
        return [

            'pelanggan_id' =>
                Pelanggan::inRandomOrder()->first()->id,

            'alat_band_id' =>
                AlatBand::inRandomOrder()->first()->id,

            'tanggal_sewa' =>
                fake()->date(),

            'tanggal_kembali' =>
                fake()->date(),

            'jumlah' =>
                fake()->numberBetween(1,5),

            'total_harga' =>
                fake()->numberBetween(50000,300000),

            'status' =>
                fake()->randomElement([
                    'Dipinjam',
                    'Dikembalikan'
                ]),
        ];
    }
}