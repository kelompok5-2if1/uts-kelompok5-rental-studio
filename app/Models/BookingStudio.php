<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStudio extends Model
{
    protected $fillable = [
        'pelanggan_id',
        'studio_id',
        'tanggal_booking',
        'jam_mulai',
        'jam_selesai',
        'total_harga',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}