<?php

namespace App\Http\Controllers;

use App\Models\estadia_enfermedad;
use App\Models\laboratorio;
use App\Models\punto_atencion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrediccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puntos_atencion = punto_atencion::all();
        return view('analisis.prediccion', compact('puntos_atencion'));
    }

    public function getDataHospital($id, $fecha_ini, $fecha_fin)
    {
        $data = laboratorio::
        select(DB::raw('fecha_ini, COUNT(*) as nContagios'))
        ->where('fecha_ini', '>=', $fecha_ini)
        ->groupBy('fecha_ini')
        ->orderBy('fecha_ini', 'asc')
        ->get();
        // $data = $puntoAtencion->estadiasEnfermedades();
        return response()->json( ['data' => $data]);
    }
}
