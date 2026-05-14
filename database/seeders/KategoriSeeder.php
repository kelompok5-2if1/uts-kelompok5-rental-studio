<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create([
            'nama_kategori' => 'Gitar'
        ]);

        Kategori::create([
            'nama_kategori' => 'Drum'
        ]);

        Kategori::create([
            'nama_kategori' => 'Keyboard'
        ]);
    }
}