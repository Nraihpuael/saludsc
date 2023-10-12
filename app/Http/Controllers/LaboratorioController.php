<?php

namespace App\Http\Controllers;

use App\Exports\LaboratorioExport;
use App\Models\estadia_enfermedad;
use App\Models\laboratorio;
use App\Models\punto_atencion;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class LaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $laboratorios = laboratorio::paginate(10);;
        return view('analisis.laboratorios.index', compact('laboratorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $puntosAtenciones = punto_atencion::all();
        $estadia_enfermedad = estadia_enfermedad::all();
        //dd($estadia_enfermedad[2]->estadia_enfermedable->nombre);
        return view('analisis.laboratorios.create', compact(
            'users','puntosAtenciones','estadia_enfermedad'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'estadia_enfermedad_id' => 'required|integer',
            'fecha_toma' => 'nullable|date',
            'hospitalizado' => 'nullable|string|max:20',
            'resultado' => 'nullable|string',
            'observaciones' => 'nullable|string', 
        ]);

        $estadia_enfermedad = estadia_enfermedad::find($validatedData['estadia_enfermedad_id']);
        //dd($estadia_enfermedad);
        $puntosAtencion = $estadia_enfermedad->estadia_enfermedable;
        $paciente = $estadia_enfermedad->user;

        $laboratorio = new laboratorio();
        $laboratorio->fecha_ingreso = $estadia_enfermedad->fecha_ini;
        $laboratorio->ap_paterno = $paciente->ap_paterno;
        $laboratorio->name = $paciente->name;
        $laboratorio->genero = $paciente->genero;
        $laboratorio->departamento =  $paciente->departamento;
        $laboratorio->localidad =  $paciente->localidad ;
        $laboratorio->barrio =  $paciente->barrio;
        $laboratorio->telefono = $paciente->telefono;
        $laboratorio->hospitalizado = $validatedData['hospitalizado'];
        $laboratorio->punto_atencion = $puntosAtencion->nombre;
        $laboratorio->fecha_ini = $estadia_enfermedad->fecha_ini;
        $laboratorio->fecha_toma = $validatedData['fecha_toma'];
        $laboratorio->resultados = $validatedData['resultado'];
        $laboratorio->observaciones = $validatedData['observaciones'];
        $laboratorio->estadia_enfermedad_id = $validatedData['estadia_enfermedad_id'];

        $laboratorio->save();

        return redirect()->back()->with('message', 'Resultados de laboratorio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(laboratorio $laboratorio)
    {
        $caso = $laboratorio;
        return view('analisis.laboratorios.show', compact('caso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(laboratorio $laboratorio)
    {
        $caso = $laboratorio;
        return view('analisis.laboratorios.edit', compact('caso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, laboratorio $laboratorio)
    {
        $validatedData = $request->validate([
            'fecha_toma' => 'nullable|date',
            'hospitalizado' => 'nullable|string|max:20',
            'resultado' => 'nullable|string',
            'observaciones' => 'nullable|string', 
        ]);


        $laboratorio->hospitalizado = $validatedData['hospitalizado'];
        $laboratorio->fecha_toma = $validatedData['fecha_toma'];
        $laboratorio->resultados = $validatedData['resultado'];
        $laboratorio->observaciones = $validatedData['observaciones'];


        $laboratorio->update();

        return redirect()->route('laboratorios.index');
    }

    public function destroy(laboratorio $laboratorio)
    {
        $laboratorio->delete();
        return redirect()->route('laboratorios.index');
    }

    public function excel(){
        return Excel::download(new LaboratorioExport, 'lab.xlsx');
    }
}