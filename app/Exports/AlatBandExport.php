<?php

namespace App\Exports;

use App\Models\AlatBand;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlatBandExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AlatBand::all();
    }
}
