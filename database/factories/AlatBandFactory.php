<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlatBandFactory extends Factory
{
    public function definition(): array
    {
        $kategori = Kategori::query()->inRandomOrder()->first() ?? Kategori::create([
            'nama_kategori' => 'Umum',
            'deskripsi' => 'Kategori default untuk data uji',
        ]);

        return [
            'kategori_alat_id' => $kategori->id,
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