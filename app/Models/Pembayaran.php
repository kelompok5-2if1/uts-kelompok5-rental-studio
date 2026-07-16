<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'booking_studio_id',
        'rental_alat_id',
        'jenis_transaksi',
        'tanggal_bayar',
        'metode_bayar',
        'total_bayar',
        'nominal_dibayar',
        'kembalian',
        'status'
    ];

    public function bookingStudio()
    {
        return $this->belongsTo(BookingStudio::class);
    }

    public function rentalAlat()
    {
        return $this->belongsTo(RentalAlat::class);
    }
}