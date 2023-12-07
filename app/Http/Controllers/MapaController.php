<?php

namespace App\Http\Controllers;

use App\Models\enfermedad_viral;
use App\Models\enfermedad_viral_mapa;
use App\Models\estadia_enfermedad;
use App\Models\mapa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapas = mapa::paginate(10);
        return view('analisis.mapas.index', compact('mapas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enfermedades = enfermedad_viral::all();
        return view('analisis.mapas.create', compact('enfermedades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mapa = mapa::create($request->all());
        $mapa->enfermedad_virals()->attach($request->enfermedadesID, ['created_at' => now(), 'updated_at' => now()]);
        return redirect()->route('mapas.create')->with('success', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapa  $mapa
     * @return \Illuminate\Http\Response
     */
    public function show(Mapa $mapa)
    {
        $enfermedadesIds = $mapa->enfermedad_virals->pluck('id')->toArray();

        $userIds = DB::table('estadia_enfermedads')
            ->join('estados', 'estadia_enfermedads.estado_id', '=', 'estados.id')
            ->select('estadia_enfermedads.user_id')
            ->where('estados.estado', 'Confirmado')
            ->whereIn('enfermedad_id', $enfermedadesIds)
            ->get();

        //dd( $userIds[0]);
        $userIdsArray = collect($userIds)->pluck('user_id')->toArray();
        //dd( $userIdsArray);
        $puntos = User::whereIn('id', $userIdsArray)
            ->whereNotNull('latitud')
            ->select('id', 'latitud', 'longitud')
            ->get();
    
        //dd( $puntos);
        //$puntos2 = [];
        //for ($i = 1; $i <= 70; $i++) {
        //    $puntos2[] = $puntos[0]; 
        //}

        //for ($i = 1; $i <= 1; $i++) {
        //    $puntos2[] = $puntos[15]; 
        //}

        // $puntos2[] = $puntos[0];
        // $puntos2[] = $puntos[15];
        // return [$puntos2[0], $puntos[15]];
        //$puntos = $puntos2;
        //dd( $puntos[2]);
        //dd( $puntos);
        // return $puntos;
        // En Revision
        return view('analisis.mapas.show',compact('mapa','puntos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapa  $mapa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapa $mapa)
    {
        $enfermedades = enfermedad_viral::all();
        $enferGuardadas = $mapa->enfermedad_virals->pluck('id');
        return view('analisis.mapas.edit', compact('enfermedades', 'mapa', 'enferGuardadas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapa  $mapa
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Mapa $mapa)
    // {
    //     $nuevosValores = $request->only(['name', 'detalle', 'latitud', 'longitud']);
    //     mapa::whereIn('id', [$mapa->id])->update($nuevosValores);
    //     enfermedad_viral_mapa::where('mapa_id', $mapa->id)->delete();

    //     foreach ($request->enfermedadesID as $enfermedad_id) {
    //         enfermedad_viral_mapa::create([
    //             'mapa_id' => $mapa->id,
    //             'enfermedad_viral_id' => $enfermedad_id
    //         ]);
    //     }

    //     return $request;
    // }

    public function update(Request $request, Mapa $mapa)
    {
        $nuevosValores = $request->only(['name', 'detalle', 'latitud', 'longitud']);
        $mapa->update($nuevosValores);
        $mapa->enfermedad_virals()->detach();
        $mapa->enfermedad_virals()->attach($request->enfermedadesID, ['created_at' => now(), 'updated_at' => now()]);

        return redirect()->route('mapas.edit',$mapa)->with('success', 'ok');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapa  $mapa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapa $mapa)
    {
        $mapa->enfermedad_virals()->detach();
        mapa::destroy($mapa->id);
        return redirect()->route('mapas.index',$mapa);
    }


}
