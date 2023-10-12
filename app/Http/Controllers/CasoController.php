<?php

namespace App\Http\Controllers;

use App\Models\estadia_enfermedad;
use Illuminate\Http\Request;

class CasoController extends Controller
{
    public function ver($id)
    {
        $noti = \Illuminate\Notifications\DatabaseNotification::find($id);

        $noti->markAsRead();
        
        $estadia = estadia_enfermedad::find($noti->data['estadia']['id']);

        if( $noti->data['estadia']['estadia_enfermedable_type'] == 'App\Models\punto_atencion')
            return redirect()->route('registrarcasosPunto.show',['registrarcasosPunto' => $estadia]);
        else
            return redirect()->route('registrarcasosBrigada.show',['registrarcasosBrigada' => $estadia]);
    }
}
