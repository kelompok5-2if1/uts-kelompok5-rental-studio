<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        Pelanggan::create([
            'nama' => 'Rifki Ramdhani',
            'email' => 'rifki@gmail.com',
            'alamat' => 'Bandung',
            'no_hp' => '081234567890'
        ]);

        Pelanggan::create([
            'nama' => 'Dzakwan Alif',
            'email' => 'dzakwan@gmail.com',
            'alamat' => 'Cimahi',
            'no_hp' => '081298765432'
        ]);

        Pelanggan::create([
            'nama' => 'Raka Mulfaidzy',
            'email' => 'raka@gmail.com',
            'alamat' => 'Garut',
            'no_hp' => '082211223344'
        ]);
    }
}