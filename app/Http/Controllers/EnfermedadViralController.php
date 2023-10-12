<?php

namespace App\Http\Controllers;

use App\Models\bitacora;
use App\Models\enfermedad_viral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnfermedadViralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enfermedades = enfermedad_viral::paginate(10);
        return view('enfermedades.index', compact('enfermedades'));
    }

    public function create()
    {
        return view('enfermedades.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string'
        ]);
      
        $enfermedad = new enfermedad_viral;
        $enfermedad->nombre = $request->nombre;
        $enfermedad->descripcion = $request->descripcion;
        
        $enfermedad->save();
        bitacora::create([
            'accion' => 'Agregar enfermedad',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' Agrego la enfermedad: '.$enfermedad->nombre,
            'id_user' => Auth::user()->id,
        ]);
        return redirect()->route('enfermedades.index')->with('success', 'Punto de atencion creado exitosamente.');
    }

    
    public function show(enfermedad_viral $enfermedade)
    {
        return view('enfermedades.show',compact('enfermedade') );
    }

    public function edit(enfermedad_viral $enfermedade)
    {
        
        return view('enfermedades.edit',compact('enfermedade') );
    }

    
    public function update(Request $request, enfermedad_viral $enfermedade)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string'
        ]);
      
        $enfermedade->nombre = $request->nombre;
        $enfermedade->descripcion = $request->descripcion;
        
        $enfermedade->update();
        bitacora::create([
            'accion' => 'Editar enfermedad',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' Actualizo informacion de la enfermedad con id: '.$enfermedade->id,
            'id_user' => Auth::user()->id,
        ]);
        return redirect()->route('enfermedades.index')->with('success', 'Punto de atencion creado exitosamente.');
    }

    public function destroy(enfermedad_viral $enfermedade)
    {
        bitacora::create([
            'accion' => 'eliminar enfermedad',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' Elimino la enfermedad: '.$enfermedade->nombre,
            'id_user' => Auth::user()->id,
        ]);
        $enfermedade->delete();
        return redirect()->route('enfermedades.index')->with('success', 'Punto de atencion actualizado exitosamente.');
    }
}
