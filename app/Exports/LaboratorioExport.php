<?php

namespace App\Exports;

use App\Models\laboratorio;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaboratorioExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        return view('analisis.laboratorios.export.temp', ['casos' => laboratorio::all()]);
    }
}