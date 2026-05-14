<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;

class StudioSeeder extends Seeder
{
    public function run(): void
    {
        Studio::create([
            'nama_studio' => 'Studio A',
            'kapasitas' => 5,
            'harga_per_jam' => 50000,
            'status' => 'Tersedia'
        ]);

        Studio::create([
            'nama_studio' => 'Studio B',
            'kapasitas' => 8,
            'harga_per_jam' => 75000,
            'status' => 'Dipakai'
        ]);

        Studio::create([
            'nama_studio' => 'Studio VIP',
            'kapasitas' => 10,
            'harga_per_jam' => 100000,
            'status' => 'Tersedia'
        ]);
    }
}