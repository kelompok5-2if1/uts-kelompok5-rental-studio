<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::insert([
            ['nama_kategori' => 'Gitar'],
            ['nama_kategori' => 'Drum'],
            ['nama_kategori' => 'Keyboard'],
            ['nama_kategori' => 'Bass'],
            ['nama_kategori' => 'Audio'],
        ]);
    }
}