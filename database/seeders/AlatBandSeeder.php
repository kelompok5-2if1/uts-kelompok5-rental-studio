<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlatBand;

class AlatBandSeeder extends Seeder
{
    public function run(): void
    {
        AlatBand::create([
            'kategori_alat_id' => 1,
            'nama_alat' => 'Yamaha Guitar',
            'stok' => 4,
            'harga_sewa' => 30000,
            'kondisi' => 'Baik'
        ]);

        AlatBand::create([
            'kategori_alat_id' => 2,
            'nama_alat' => 'Pearl Drum',
            'stok' => 2,
            'harga_sewa' => 80000,
            'kondisi' => 'Baik'
        ]);

        AlatBand::create([
            'kategori_alat_id' => 3,
            'nama_alat' => 'Roland Keyboard',
            'stok' => 3,
            'harga_sewa' => 60000,
            'kondisi' => 'Rusak Ringan'
        ]);
    }
}