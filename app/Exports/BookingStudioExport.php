<?php

namespace App\Exports;

use App\Models\BookingStudio;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookingStudioExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BookingStudio::all();
    }
}
