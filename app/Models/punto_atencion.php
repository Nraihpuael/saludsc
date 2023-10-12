<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class punto_atencion extends Model
{
    use HasFactory;

    protected $table = 'punto_atencions';

    protected $fillable = ['nombre','ubicacion','longitud','latitud','num_camillas','num_cuartos','id_tipo_punto'];

    //uno a muchos polimorficas
    public function estadiasEnfermedades(){
        return $this->morphMany('App\Models\estadia_enfermedad','estadia_enfermedable');
    }
    
    public function tipo(){
        return $this->belongsTo('App\Models\tipo_punto', 'id_tipo_punto', 'id');
    }

    public function solicitudes(){
        return $this->hasMany('App\Models\solicitud','punto_atencion_id');
    }

    public function equipos(){
        return $this->belongsToMany('App\Models\equipo', 'punto_equipo');
    }

}
