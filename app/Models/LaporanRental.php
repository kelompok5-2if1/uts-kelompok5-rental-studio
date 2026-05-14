<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanRental extends Model
{
    protected $fillable = [
        'tanggal_laporan',
        'total_transaksi',
        'total_pendapatan',
        'keterangan'
    ];
}