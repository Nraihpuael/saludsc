<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\bitacora;
use App\Models\Resultado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        try {            
            $rol = Auth::user()->roles->first();
            if ($rol->name == 'Admin' || $rol->name == "Funcionario") {
                $atenciones = Atencion::all()->pluck('id');
            } else if ($rol->name == 'Paciente') {
                $atenciones = Atencion::where('paciente_id', Auth::user()->id)->pluck('id');
            } else if ( $rol->name == 'Personal Médico'){
                $atenciones = Atencion::where('medico_id', Auth::user()->id)->pluck('id');
            }
            $resultados = Resultado::whereIn('atencion_id', $atenciones)->paginate(10);
            return view('resultados.index', compact('resultados'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'ocurrio un erro: ' . $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $resultado = Resultado::create($request->all());
        $atencione = Atencion::find($request->atencion_id);
        bitacora::create([
            'accion' => 'Registrar Resultado de Atencion',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' agrego resultado a la atencion con id: '.$resultado->atencion_id,
            'id_user' => Auth::user()->id,
        ]);
        return redirect()->route('atenciones.show',$atencione)->with('success', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Resultado $resultado)
    {
        return view('resultados.show',compact('resultado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resultado $resultado)
    {
        $resultado->delete();
        bitacora::create([
            'accion' => 'Registrar Resultado de Atencion',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' removio el resultado con id: '.$resultado->id,
            'id_user' => Auth::user()->id,
        ]);
        return redirect()->route('resultados.index');
    }
}
