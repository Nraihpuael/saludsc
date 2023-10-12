<?php

namespace App\Http\Controllers;

use App\Models\bitacora;
use App\Models\brigada;
use App\Models\lugar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrigadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brigadas = brigada::paginate(10);
        return view('brigadas.index', compact('brigadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lugares = lugar::all();
        $users = User::all();
        return view('brigadas.create', compact('lugares','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brigada = brigada::create($request->all());
        $brigada->users()->attach($request->usersID, ['created_at' => now(), 'updated_at' => now()]);
        bitacora::create([
            'accion' => 'Registrar Brigada',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' agrego una nueva brigada con id: '.$brigada->id . ' con usuarios con id: ' . implode(", ", $request->usersID),
            'id_user' => Auth::user()->id,
        ]);
        return redirect()->route('brigadas.create')->with('success', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brigada  $brigada
     * @return \Illuminate\Http\Response
     */
    public function show(brigada $brigada)
    {
        // $lugar = $brigada->lugar;
        // return $brigada->users;
        return view('brigadas.show',compact('brigada'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brigada  $brigada
     * @return \Illuminate\Http\Response
     */
    public function edit(brigada $brigada)
    {
        $lugares = lugar::all();
        $users = User::all();
        $usersGuardados = $brigada->users->pluck('id');
        $lugarGudardado = $brigada->lugar->id;
        // return $lugarGudardado;
        return view('brigadas.edit', compact('lugares','users','brigada','usersGuardados','lugarGudardado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brigada  $brigada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, brigada $brigada)
    {
        // return $request;

        $brigada->update($request->all());
        $brigada->users()->detach();
        $brigada->users()->attach($request->usersID, ['created_at' => now(), 'updated_at' => now()]);
        bitacora::create([
            'accion' => 'Editar Brigada',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' edito info de la brigada con id: '.$brigada->id . ' con usuarios con id: ' . implode(", ", $request->usersID),
            'id_user' => Auth::user()->id,
        ]);

        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');

            foreach ($imagenes as $imagen) {
                
                $rutaPublic = $imagen->store('public/Brigadas');
                $rutaStorage = Storage::url($rutaPublic);

                $brigada->fotos()->create(['uri' => $rutaStorage]);
                bitacora::create([
                    'accion' => 'Registrar Imagenes de Brigadas',
                    'descripcion' => 'El usuario ' . Auth::user()->name . ' agrego una imagen: '.$rutaStorage,
                    'id_user' => Auth::user()->id,
                ]);
            }
        }

        return redirect()->route('brigadas.edit',$brigada)->with('success', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brigada  $brigada
     * @return \Illuminate\Http\Response
     */
    public function destroy(brigada $brigada)
    {
        bitacora::create([
            'accion' => 'Eliminar Brigada',
            'descripcion' => 'El usuario ' . Auth::user()->name . ' elimino la brigdad con id: '.$brigada->id,
            'id_user' => Auth::user()->id,
        ]);
        $brigada->users()->detach();
        $brigada->delete();
        return redirect()->route('brigadas.index');
    }
}
