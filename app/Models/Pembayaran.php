<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'rental_alat_id',
        'tanggal_bayar',
        'metode_bayar',
        'total_bayar',
        'status'
    ];
}