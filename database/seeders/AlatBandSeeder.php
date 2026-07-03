<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlatBand;

class AlatBandSeeder extends Seeder
{
    public function run(): void
    {
        AlatBand::insert([

            [
                'kategori_alat_id'=>1,
                'nama_alat'=>'Yamaha Acoustic Guitar',
                'stok'=>5,
                'harga_sewa'=>30000,
                'kondisi'=>'Baik',
                'foto'=>null
            ],

            [
                'kategori_alat_id'=>1,
                'nama_alat'=>'Fender Electric Guitar',
                'stok'=>3,
                'harga_sewa'=>50000,
                'kondisi'=>'Baik',
                'foto'=>null
            ],

            [
                'kategori_alat_id'=>2,
                'nama_alat'=>'Pearl Drum Set',
                'stok'=>2,
                'harga_sewa'=>100000,
                'kondisi'=>'Baik',
                'foto'=>null
            ],

            [
                'kategori_alat_id'=>2,
                'nama_alat'=>'Yamaha Drum',
                'stok'=>2,
                'harga_sewa'=>90000,
                'kondisi'=>'Maintenance',
                'foto'=>null
            ],

            [
                'kategori_alat_id'=>3,
                'nama_alat'=>'Roland Keyboard',
                'stok'=>4,
                'harga_sewa'=>70000,
                'kondisi'=>'Baik',
                'foto'=>null
            ],

            [
                'kategori_alat_id'=>4,
                'nama_alat'=>'Ibanez Bass',
                'stok'=>3,
                'harga_sewa'=>50000,
                'kondisi'=>'Baik',
                'foto'=>null
            ],

            [
                'kategori_alat_id'=>5,
                'nama_alat'=>'Marshall Amplifier',
                'stok'=>5,
                'harga_sewa'=>40000,
                'kondisi'=>'Baik',
                'foto'=>null
            ],

            [
                'kategori_alat_id'=>5,
                'nama_alat'=>'Shure Microphone',
                'stok'=>10,
                'harga_sewa'=>20000,
                'kondisi'=>'Baik',
                'foto'=>null
            ],

        ]);
    }
}