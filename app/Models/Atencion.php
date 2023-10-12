<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','descripcion','paciente_id','medico_id'];

    //uno a muchos polimorficas
    public function fotos(){
        return $this->morphMany('App\Models\fotos','fotosable');
    }

    public function paciente(){
        return $this->belongsTo('App\Models\User','paciente_id');
    }

    public function medico(){
        return $this->belongsTo('App\Models\User','medico_id');
    }

    public function resultado(){
        return $this->hasOne('App\Models\Resultado');
    }

}
