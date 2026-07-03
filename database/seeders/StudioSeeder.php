<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;

class StudioSeeder extends Seeder
{
    public function run(): void
    {
        Studio::insert([
            [
                'nama_studio' => 'Studio A',
                'kapasitas' => 5,
                'harga_per_jam' => 50000,
                'status' => 'Tersedia'
            ],
            [
                'nama_studio' => 'Studio B',
                'kapasitas' => 8,
                'harga_per_jam' => 75000,
                'status' => 'Tersedia'
            ],
            [
                'nama_studio' => 'Studio C',
                'kapasitas' => 10,
                'harga_per_jam' => 100000,
                'status' => 'Digunakan'
            ],
            [
                'nama_studio' => 'Studio VIP',
                'kapasitas' => 15,
                'harga_per_jam' => 150000,
                'status' => 'Maintenance'
            ],
        ]);
    }
}