<?php

namespace App\Http\Controllers;

use App\Imports\CasosImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LaboratorioImport;
use App\Imports\PuntoAtencionImport;
use App\Models\laboratorio;

class ImportController extends Controller
{
    public function index()
    {
        return view('laboratorios.index');
    }

    public function importLab(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::import(new LaboratorioImport, $path);

            if ($data) {
                return redirect()->route('laboratorios.index')->with('success', 'Data imported successfully.');
            }
        }

        return redirect()->route('laboratorios.index')->with('error', 'There was an error importing data.');
    }

    

    public function importPuntoAtencion(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::import(new PuntoAtencionImport, $path);

            if ($data) {
                return redirect()->route('puntosatencion.index')->with('success', 'Data imported successfully.');
            }
        }

        return redirect()->route('puntosatencion.index')->with('error', 'There was an error importing data.');
    }


    public function importCasos(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();
            $data = Excel::import(new CasosImport, $path);

            if ($data) {
                return redirect()->route('registrarcasosPunto.index')->with('success', 'Data imported successfully.');
            }
        }
        
        return redirect()->route('registrarcasosPunto.index')->with('error', 'There was an error importing data.');
    }

}