<?php

namespace App\Exports;

use App\Models\Pelanggan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PelangganExport implements FromCollection
{
    public function collection()
    {
        return Pelanggan::all();
    }
}