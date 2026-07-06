<?php

namespace App\Exports;

use App\Models\LaporanRental;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanRentalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LaporanRental::all();
    }
}
