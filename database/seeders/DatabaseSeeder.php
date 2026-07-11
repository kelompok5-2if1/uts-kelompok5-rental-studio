<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserRoleSeeder::class,
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