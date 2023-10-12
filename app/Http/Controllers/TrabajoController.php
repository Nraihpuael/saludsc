<?php

namespace App\Http\Controllers;

use App\Models\punto_atencion;
use App\Models\trabajo;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchText = $request->input('searchText');
        $punto_atencion_id = $request->input('punto_atencion_id');

        $puntoAtencion = punto_atencion::select('id', 'nombre')
            ->where('id', $punto_atencion_id)->first();

        $medicoRole = Role::where('name', 'Personal Médico')->first();
        if ($medicoRole) {
            $medicos = $medicoRole->users()
                ->select('id', 'ci', 'name', 'email', 'telefono', 'fecha_nac')
                ->whereNotIn('id', function ($query) use ($punto_atencion_id) {
                    $query->select('user_id')
                        ->from('trabajos')
                        ->where('punto_atencion_id', $punto_atencion_id)
                        ->where('estado', 1)->get();
                })
                ->get();
        } else {
            $medicos = collect(); // Si no se encuentra el rol "medico", se devuelve una colección vacía
        }
        $trabajadores = trabajo::where('punto_atencion_id', $punto_atencion_id)->where('estado', 1)->get();

        return view('puntosatencion.trabajadores', compact('puntoAtencion', 'medicos', 'trabajadores', 'searchText'));
    }

    public function agregar(Request $request)
    {

        try {
            $trabajo = trabajo::create([
                'cargo' => $request->cargo,
                'fecha_ini' => $request->fecha_ini,
                'fecha_fin' => $request->fecha_fin,
                'user_id' => $request->user_id,
                'punto_atencion_id' => $request->punto_atencion_id
            ]);
            $trabajo->save();
            return redirect()->back()->with('message', 'Se agrego el medico al punto de atencion');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Ocurrio un error con el server');
        }
    }

    public function quitar($id)
    {
        try {
            $trabajo = trabajo::findOrFail($id);
            $trabajo->estado = 0;
            $trabajo->update();
            return redirect()->back()->with('message', 'Se quito el medico al punto de atencion');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Ocurrio un error con el server');
        }
    }
}
