<?php

namespace App\Exports;

use App\Models\DetailRental;
use Maatwebsite\Excel\Concerns\FromCollection;

class DetailRentalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DetailRental::all();
    }
}
