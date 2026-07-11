<?php

namespace App\Exports;

use App\Models\RentalAlat;
use Maatwebsite\Excel\Concerns\FromCollection;

class RentalAlatExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RentalAlat::all();
    }
}
