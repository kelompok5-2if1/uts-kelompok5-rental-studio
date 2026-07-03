<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        Pelanggan::insert([
            [
                'nama' => 'Mohammad Rifki Ramdhani Waskito',
                'email' => 'rifki@gmail.com',
                'no_hp' => '081234567890',
                'alamat' => 'Bandung'
            ],
            [
                'nama' => 'Jemima',
                'email' => 'jemima@gmail.com',
                'no_hp' => '082345678901',
                'alamat' => 'Jakarta'
            ],
            [
                'nama' => 'Andi Saputra',
                'email' => 'andi@gmail.com',
                'no_hp' => '083456789012',
                'alamat' => 'Bekasi'
            ],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'no_hp' => '084567890123',
                'alamat' => 'Bogor'
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti@gmail.com',
                'no_hp' => '085678901234',
                'alamat' => 'Depok'
            ],
        ]);
    }
}