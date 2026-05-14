<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookingStudio;

class BookingStudioSeeder extends Seeder
{
    public function run(): void
    {
        BookingStudio::create([
            'pelanggan_id' => 1,
            'studio_id' => 1,
            'tanggal_booking' => '2026-05-14',
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '12:00:00',
            'total_harga' => 100000
        ]);

        BookingStudio::create([
            'pelanggan_id' => 2,
            'studio_id' => 2,
            'tanggal_booking' => '2026-05-15',
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '15:00:00',
            'total_harga' => 150000
        ]);
    }
}