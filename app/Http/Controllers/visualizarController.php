<?php

namespace App\Http\Controllers;

use App\Models\punto_atencion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class visualizarController extends Controller
{

    public function ver()
    {
        
        $puntos = punto_atencion::all();
        // return $puntos;
        $latitudesLongitudes = [];

        foreach ($puntos as $punto) {
            $latitudesLongitudes[] = [
                'latitud' => $punto->latitud,
                'longitud' => $punto->longitud,
                'nombre' => $punto->nombre
            ];
        }
        // return $latitudesLongitudes;
        return view('puntosatencion.visualizar', compact('puntos'));
    }

    public function mostrarGraficaEnfermedades()
    {
        // Obtén la cantidad de personas enfermas por cada enfermedad
        $datosEnfermedades = DB::table('enfermedad_virals')
            ->join('estadia_enfermedads', 'enfermedad_virals.id', '=', 'estadia_enfermedads.enfermedad_id')
            ->select('enfermedad_virals.nombre', DB::raw('COUNT(*) as cantidad_enfermos'))
            ->groupBy('enfermedad_virals.nombre')
            ->get();

            $datosPuntosAtencion = DB::table('estadia_enfermedads')
            ->join('punto_atencions', 'estadia_enfermedads.estadia_enfermedable_id', '=', 'punto_atencions.id')
            ->select('punto_atencions.nombre', DB::raw('COUNT(*) AS cantidad_enfermos'))
            ->groupBy('punto_atencions.nombre')
            ->get();  

            $datosGenero = DB::table('estadia_enfermedads')
            ->join('users', 'estadia_enfermedads.user_id', '=', 'users.id')
            ->select(
                DB::raw("CASE WHEN users.genero = 'M' THEN 'Masculino' 
                              WHEN users.genero = 'F' THEN 'Femenino' END AS genero"),
                DB::raw('COUNT(*) AS cantidad_enfermos')
            )
            ->groupBy('users.genero')
            ->get();

        // Retorna la vista pasando los datos necesarios para la gráfica
        return view('dashboard', compact('datosEnfermedades', 'datosPuntosAtencion','datosGenero'));

    }
}
