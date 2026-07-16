<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalAlat extends Model
{
    protected $fillable = [
        'pelanggan_id',
        'alat_band_id',
        'tanggal_sewa',
        'tanggal_kembali',
        'jumlah',
        'total_harga',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function alatBand()
    {
        return $this->belongsTo(AlatBand::class);
    }

    public function detailRental()
    {
        return $this->hasMany(DetailRental::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}