<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RentalAlat;

class AlatBand extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_alat_id',
        'nama_alat',
        'stok',
        'harga_sewa',
        'kondisi'
    ];

    public function rentalAlat()
    {
        return $this->hasMany(RentalAlat::class);
    }
}