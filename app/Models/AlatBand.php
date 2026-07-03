<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlatBand extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_alat_id',
        'nama_alat',
        'stok',
        'harga_sewa',
        'kondisi',
        'foto'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_alat_id');
    }
}