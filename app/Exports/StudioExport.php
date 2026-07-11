<?php

namespace App\Exports;

use App\Models\Studio;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudioExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Studio::all();
    }
}
