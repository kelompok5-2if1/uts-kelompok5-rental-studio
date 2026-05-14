<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailRental extends Model
{
    protected $fillable = [
        'rental_alat_id',
        'alat_band_id',
        'jumlah',
        'durasi',
        'subtotal'
    ];
}