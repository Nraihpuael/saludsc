<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estadia_enfermedad extends Model
{
    use HasFactory;

    protected $fillable = ['fecha_ini','user_id','estado_id','enfermedad_id','estadia_id','detalle'];

    /*
    Relacion polimorfica
    public function estadia_enfermedable(){
        return $this->morphTo();
    }
    */

    //Relacion con user uno a muchos inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function estado(){
        return $this->belongsTo('App\Models\estado');
    }

    public function enfermedad_viral(){
        return $this->belongsTo('App\Models\enfermedad_viral','enfermedad_id');
    }

    public function estadia(){
        return $this->belongsTo('App\Models\punto_atencion');
    }

    public function sintomas(){
        return $this->belongsToMany('App\Models\sintoma');
    }
    
}
