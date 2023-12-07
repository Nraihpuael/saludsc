<?php

namespace App\Exports;

use App\Models\bitacora;
use Maatwebsite\Excel\Concerns\FromCollection;

class BitacoraExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return bitacora::all();
    }
}
