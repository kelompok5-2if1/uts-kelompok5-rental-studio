<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingStudioFactory extends Factory
{
    public function definition(): array
    {
        return [

            'pelanggan_id' =>
                Pelanggan::inRandomOrder()->first()->id,

            'studio_id' =>
                Studio::inRandomOrder()->first()->id,

            'tanggal_booking' =>
                fake()->date(),

            'jam_mulai' =>
                '10:00:00',

            'jam_selesai' =>
                '12:00:00',

            'total_harga' =>
                fake()->numberBetween(100000,500000),
        ];
    }
}