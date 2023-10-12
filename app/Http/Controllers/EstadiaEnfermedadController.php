<?php

namespace App\Http\Controllers;

use App\Exports\EstadiaExport;
use App\Models\brigada;
use App\Models\enfermedad_viral;
use App\Models\estadia_enfermedad;
use App\Models\estado;
use App\Models\punto_atencion;
use App\Models\sintoma;
use App\Models\User;
use App\Notifications\estadiaNotification;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EstadiaEnfermedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casos = estadia_enfermedad::where('estadia_enfermedable_type','App\Models\punto_atencion')->paginate(10);
        return view('puntosatencion.registrarcasos.index', compact('casos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $estados = estado::all();
        $enfermedades = enfermedad_viral::all();
        $puntosAtenciones = punto_atencion::all();
        $sintomas = sintoma::all();
        return view('puntosatencion.registrarcasos.create', compact('sintomas','users', 'estados', 'enfermedades','puntosAtenciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $puntoAtencion = punto_atencion::find($request->punto_atencion_id);
        $estadia = $puntoAtencion->estadiasEnfermedades()->create($request->all());
        $estadia->sintomas()->attach($request->sintoma_id, ['created_at' => now(), 'updated_at' => now()]);

        $user = User::find($estadia->user_id);
        $user->notify(new estadiaNotification($estadia));

        return redirect()->route('registrarcasosPunto.create')->with('success', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\estadia_enfermedad  $estadia_enfermedad
     * @return \Illuminate\Http\Response
     */
    public function show(estadia_enfermedad $registrarcasosPunto)
    {
        // return $registrarcasosPunto;
        $caso = $registrarcasosPunto;
        $puntoAtencion = punto_atencion::find($registrarcasosPunto->estadia_enfermedable_id);
        return view('puntosatencion.registrarcasos.show', compact('caso','puntoAtencion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\estadia_enfermedad  $estadia_enfermedad
     * @return \Illuminate\Http\Response
     */
    public function edit(estadia_enfermedad $registrarcasosPunto)
    {
        $users = User::all();
        $estados = estado::all();
        $enfermedades = enfermedad_viral::all();
        $puntosAtenciones = punto_atencion::all();
        $sintomas = sintoma::all();
        $caso = $registrarcasosPunto;
        return view('puntosatencion.registrarcasos.edit', compact('users', 'estados', 'enfermedades', 'puntosAtenciones','sintomas','caso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\estadia_enfermedad  $estadia_enfermedad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estadia_enfermedad $registrarcasosPunto)
    {
        $nuevosValores = $request->only(['user_id','estado_id','enfermedad_id', 'detalle']);
        $registrarcasosPunto->sintomas()->detach();
        $registrarcasosPunto->update($nuevosValores);
        $registrarcasosPunto->estadia_enfermedable_id = $request->punto_atencion_id;
        $registrarcasosPunto->update();
        $registrarcasosPunto->sintomas()->attach($request->sintoma_id, ['created_at' => now(), 'updated_at' => now()]);

        if (isset($_POST['mySwitch'])) {
            $registrarcasosPunto->fecha_fin = now();
          } else {
            $registrarcasosPunto->fecha_fin = null;
          }

        $registrarcasosPunto->update();

        $caso = $registrarcasosPunto;
        return redirect()->route('registrarcasosPunto.edit',$caso)->with('success', 'ok'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estadia_enfermedad  $estadia_enfermedad
     * @return \Illuminate\Http\Response
     */
    public function destroy(estadia_enfermedad $registrarcasosPunto)
    {
        $registrarcasosPunto->sintomas()->detach();
        $registrarcasosPunto->delete();
        return redirect()->route('registrarcasosPunto.index');
    }

    public function excel(){
        return Excel::download(new EstadiaExport, 'estadiaPuntoAtencion.xlsx');
    }
}
