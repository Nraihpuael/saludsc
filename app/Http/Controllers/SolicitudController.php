<?php

namespace App\Http\Controllers;

use App\Models\punto_atencion;
use App\Models\solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = Auth::user()->roles->first();
        if ($rol->name == 'Paciente') {
            $solicitudes = solicitud::where('user_id', Auth::user()->id)->paginate(10);
        }else{
            $solicitudes = solicitud::paginate(10);
        }
        return view('puntosatencion.solicitudes.index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $puntos = punto_atencion::all();
        return view('puntosatencion.solicitudes.create', compact('puntos'));
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
        solicitud::create($request->all());
        return redirect()->route('solicitudes.create')->with('success', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(solicitud $solicitude)
    {
        $puntoGudardado2 = solicitud::where('punto_atencion_id',$solicitude->punto_atencion_id)->first();
        $puntoGudardado = $puntoGudardado2->punto_atencion_id;
        $puntos = punto_atencion::all();
        return view('puntosatencion.solicitudes.show', compact('solicitude','puntoGudardado','puntos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(solicitud $solicitude)
    {
        $puntos = punto_atencion::all();
        $puntoGudardado = solicitud::where('punto_atencion_id',$solicitude->punto_atencion_id)->first();
        $puntoSolicitado = $puntoGudardado->punto_atencion_id;
        // return $puntoSolicitado;
        return view('puntosatencion.solicitudes.edit',compact('solicitude','puntoSolicitado','puntos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, solicitud $solicitude)
    {
        $solicitude->update($request->all());
        return redirect()->route('solicitudes.edit',$solicitude)->with('success', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(solicitud $solicitude)
    {
        $solicitude->delete();
        return redirect()->route('solicitudes.index');
    }
}
