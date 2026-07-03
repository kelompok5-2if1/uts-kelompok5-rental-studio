<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_studio' => fake()->randomElement([
                'Studio A',
                'Studio B',
                'Studio C',
                'Studio VIP'
            ]),
            'kapasitas' => fake()->numberBetween(2,15),
            'harga_per_jam' => fake()->numberBetween(50000,250000),
            'status' => fake()->randomElement([
                'Tersedia',
                'Digunakan',
                'Maintenance'
            ]),
        ];
    }
}