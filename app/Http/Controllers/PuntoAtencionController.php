<?php

namespace App\Http\Controllers;

use App\Models\punto_atencion;
use App\Models\tipo_punto;
use Illuminate\Http\Request;

class PuntoAtencionController extends Controller
{
    
    public function index()
    {
        $puntosatencion = punto_atencion::paginate(10);
        return view('puntosatencion.index', compact('puntosatencion'));
    }

    
    public function create()
    {
        $tipos = tipo_punto::all();
        return view('puntosatencion.create', compact('tipos'));
    }

    
    public function store(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|string',
            'num_camillas' => 'nullable|integer',
            'num_cuartos' => 'nullable|integer',
            'id_tipo_punto' => ['required'],
            'ubicacion' => 'nullable|string',
            'longitud' => 'nullable|numeric',
            'latitud' =>'nullable|numeric'
        ]);
      
        $punto = new punto_atencion;
        $punto->nombre = $request->nombre;
        $punto->ubicacion = $request->ubicacion;
        $punto->longitud = $request->longitud;
        $punto->latitud = $request->latitud;
        $punto->num_camillas = $request->num_camillas;
        $punto->num_cuartos = $request->num_cuartos;
        $punto->id_tipo_punto = $request->id_tipo_punto;
        
        $punto->save();
        return redirect()->route('puntosatencion.index')->with('success', 'Punto de atencion creado exitosamente.');
    }

    
    public function show(punto_atencion $puntosatencion)
    {
        $tipo = tipo_punto::find($puntosatencion->id_tipo_punto );
        
        if($tipo != null){
            $tipo = $tipo->nombre;
        }
        return view('puntosatencion.show', compact('tipo','puntosatencion'));
    }

    
    public function edit(punto_atencion $puntosatencion)
    {
        
        $tipos = tipo_punto::all();
        return view('puntosatencion.edit', compact('tipos','puntosatencion'));
    }

    
    public function update(Request $request, punto_atencion $puntosatencion)
    {
        $request->validate([
            'nombre' => 'required|string',
            'num_camillas' => 'nullable|integer',
            'num_cuartos' => 'nullable|integer',
            'id_tipo_punto' => ['required'],
            'ubicacion' => 'nullable|string',
            'longitud' => 'nullable|numeric',
            'latitud' =>'nullable|numeric'
        ]);
      
        $puntosatencion->nombre = $request->nombre;
        $puntosatencion->ubicacion = $request->ubicacion;
        $puntosatencion->longitud = $request->longitud;
        $puntosatencion->latitud = $request->latitud;
        $puntosatencion->num_camillas = $request->num_camillas;
        $puntosatencion->num_cuartos = $request->num_cuartos;
        $puntosatencion->id_tipo_punto = $request->id_tipo_punto;

        $puntosatencion->update();
        return redirect()->route('puntosatencion.index')->with('success', 'Punto de atencion actualizado exitosamente.');
    }

   
    public function destroy(punto_atencion $puntosatencion)
    {
        $puntosatencion->delete();
        return redirect()->route('puntosatencion.index')->with('success', 'Punto de atencion actualizado exitosamente.');
    }
}
