<?php

namespace App\Http\Controllers;

use App\Models\equipo;
use App\Models\punto_atencion;
use App\Models\punto_equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipos = equipo::paginate(10);
        return view('puntosatencion.equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $punto_atencions = punto_atencion::all();
        return view('puntosatencion.equipos.create', compact('punto_atencions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $equipo = equipo::create($request->all());
        $equipo->punto_atencions()->attach($request->punto_atencion_id, ['cantidad' => $request->cantidad, 'created_at' => now(), 'updated_at' => now()]);
        return redirect()->route('equipos.create')->with('success', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(equipo $equipo)
    {
        
        return view('puntosatencion.equipos.show', compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(equipo $equipo)
    {
        $puntoAtencionGuardado = $equipo->punto_atencions()->first()->id;
        $punto_atencions = punto_atencion::all();
        return view('puntosatencion.equipos.edit', compact('equipo','punto_atencions','puntoAtencionGuardado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, equipo $equipo)
    {
        $nuevosValores = $request->only(['nombre', 'descripcion', 'cantidad']);
        $equipo->update($nuevosValores);
        $equipo->punto_atencions()->detach();
        $equipo->punto_atencions()->attach($request->punto_atencion_id, ['cantidad' => $request->cantidad, 'created_at' => now(), 'updated_at' => now()]);
        
        return redirect()->route('equipos.edit',$equipo)->with('success', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(equipo $equipo)
    {
        $equipo->punto_atencions()->detach();
        $equipo->delete();
        return redirect()->route('equipos.index');
    }
}
