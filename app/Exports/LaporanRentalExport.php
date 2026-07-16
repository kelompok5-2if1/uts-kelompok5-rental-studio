<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanRentalExport implements FromCollection
{
    protected $rows;

    public function __construct($rows = [])
    {
        $this->rows = $rows;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->rows);
    }
}
