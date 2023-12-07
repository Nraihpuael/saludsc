<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brigada extends Model
{
    use HasFactory;

    protected $fillable = ['name','lugar_id'];

    //uno a muchos polimorficas
    public function estadiasEnfermedades(){
        return $this->morphMany('App\Models\estadia_enfermedad','estadia_enfermedable');
    }

    //uno a muchos polimorficas
    public function fotos(){
        return $this->morphMany('App\Models\fotos','fotosable');
    }

    public function lugar(){
        return $this->belongsTo('App\Models\lugar');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

}
