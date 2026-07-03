<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlatBandFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kategori_alat_id' => Kategori::inRandomOrder()->first()->id,
            'nama_alat' => fake()->randomElement([
                'Yamaha Guitar',
                'Pearl Drum',
                'Roland Keyboard',
                'Marshall Amplifier',
                'Shure Mic'
            ]),
            'stok' => fake()->numberBetween(1,20),
            'harga_sewa' => fake()->numberBetween(25000,150000),
            'kondisi' => fake()->randomElement([
                'Baik',
                'Rusak',
                'Maintenance'
            ]),
            'foto' => null,
        ];
    }
}