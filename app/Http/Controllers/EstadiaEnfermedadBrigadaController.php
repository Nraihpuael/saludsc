<?php

namespace App\Http\Controllers;

use App\Exports\EstadiaBrigadaExport;
use App\Models\brigada;
use App\Models\enfermedad_viral;
use App\Models\estadia_enfermedad;
use App\Models\estado;
use App\Models\sintoma;
use App\Models\User;
use App\Notifications\estadiaNotification;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EstadiaEnfermedadBrigadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casos = estadia_enfermedad::where('estadia_enfermedable_type', 'App\Models\brigada')->paginate(10);
        return view('brigadas.registrarcasos.index', compact('casos'));
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
        $brigadas = brigada::all();
        $sintomas = sintoma::all();
        return view('brigadas.registrarcasos.create', compact('users', 'estados', 'enfermedades', 'brigadas','sintomas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $brigada = brigada::find($request->brigada_id);
        $estadia = $brigada->estadiasEnfermedades()->create($request->all());
        $estadia->sintomas()->attach($request->sintoma_id, ['created_at' => now(), 'updated_at' => now()]);

        $user = User::find($estadia->user_id);
        $user->notify(new estadiaNotification($estadia));

        return redirect()->route('registrarcasosBrigada.create')->with('success', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(estadia_enfermedad $registrarcasosBrigada)
    {
        $caso = $registrarcasosBrigada;
        $brigada = brigada::find($registrarcasosBrigada->estadia_enfermedable_id);
        return view('brigadas.registrarcasos.show', compact('caso','brigada'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(estadia_enfermedad $registrarcasosBrigada)
    {
        // return $registrarcasosBrigada;
        $users = User::all();
        $estados = estado::all();
        $enfermedades = enfermedad_viral::all();
        $brigadas = brigada::all();
        $sintomas = sintoma::all();
        $caso = $registrarcasosBrigada;
        return view('brigadas.registrarcasos.edit', compact('users', 'estados', 'enfermedades', 'brigadas','sintomas','caso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estadia_enfermedad $registrarcasosBrigada)
    {

        $nuevosValores = $request->only(['user_id','estado_id','enfermedad_id', 'detalle']);
        $registrarcasosBrigada->sintomas()->detach();
        $registrarcasosBrigada->update($nuevosValores);
        $registrarcasosBrigada->estadia_enfermedable_id = $request->brigada_id;
        $registrarcasosBrigada->update();
        $registrarcasosBrigada->sintomas()->attach($request->sintoma_id, ['created_at' => now(), 'updated_at' => now()]);

        if (isset($_POST['mySwitch'])) {
            $registrarcasosBrigada->fecha_fin = now();
          } else {
            $registrarcasosBrigada->fecha_fin = null;
          }

        $registrarcasosBrigada->update();

        $caso = $registrarcasosBrigada;
        return redirect()->route('registrarcasosBrigada.edit',$caso)->with('success', 'ok'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(estadia_enfermedad $registrarcasosBrigada)
    {
        $registrarcasosBrigada->sintomas()->detach();
        $registrarcasosBrigada->delete();
        return redirect()->route('registrarcasosBrigada.index'); 
    }

    public function excel(){
        return Excel::download(new EstadiaBrigadaExport, 'estadiaBrigada.xlsx');
    }
}
