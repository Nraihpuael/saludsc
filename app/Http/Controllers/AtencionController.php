<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use App\Models\bitacora;
use App\Models\brigada;
use App\Models\fotos;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = Auth::user()->roles->first();
        if ($rol->name == 'Admin' || $rol->name == "Funcionario") {
            $atenciones = Atencion::paginate(10);
        } else if ($rol->name == 'Paciente') {
            $atenciones = Atencion::where('paciente_id', Auth::user()->id)->paginate(10);
        } else if ( $rol->name == 'Personal Médico'){
            $atenciones = Atencion::where('medico_id', Auth::user()->id)->paginate(10);
        }
        return view('atenciones.index', compact('atenciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicos = Role::whereName('Personal Médico')->first()->users()->get();
        return view('atenciones.create', compact('medicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $atencion = Atencion::create($request->all());

        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');

            foreach ($imagenes as $imagen) {

                $rutaPublic = $imagen->store('public/Fotos_Atenciones');
                $rutaStorage = Storage::url($rutaPublic);

                $atencion->fotos()->create(['uri' => $rutaStorage]);
                bitacora::create([
                    'accion' => 'Registrar Imagenes de Atencion de usuario',
                    'descripcion' => 'El usuario ' . Auth::user()->name . ' agrego una imagen: ' . $rutaStorage,
                    'id_user' => Auth::user()->id,
                ]);
            }
        }

        bitacora::create([
            'accion' => 'Registrar Atencion de usuario',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' agrego atencion al usuario con id: ' . $atencion->paciente_id,
            'id_user' => Auth::user()->id,
        ]);

        return redirect()->route('atenciones.create', $atencion)->with('success', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Atencion $atencione)
    {
        // dd($atencion);
        // $fotos = fotos::all();
        // return $atencione;
        // return count($atencione->resultado);
        return view('atenciones.show', compact('atencione'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atencion $atencione)
    {
        $atencione->delete();
        return redirect()->route('atenciones.index');
    }
}
