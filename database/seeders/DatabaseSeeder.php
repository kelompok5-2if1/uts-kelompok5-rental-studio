<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PelangganSeeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\StudioSeeder;
use Database\Seeders\AlatBandSeeder;
use Database\Seeders\BookingStudioSeeder;
use Database\Seeders\RentalAlatSeeder;
use Database\Seeders\DetailRentalSeeder;
use Database\Seeders\PembayaranSeeder;
use Database\Seeders\LaporanRentalSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PelangganSeeder::class,
            KategoriSeeder::class,
            StudioSeeder::class,
            AlatBandSeeder::class,
            BookingStudioSeeder::class,
            RentalAlatSeeder::class,
            DetailRentalSeeder::class,
            PembayaranSeeder::class,
            LaporanRentalSeeder::class,
        ]);
    }
}