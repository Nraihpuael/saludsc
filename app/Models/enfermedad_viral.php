<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enfermedad_viral extends Model
{
    use HasFactory, HasTimestamps;

    public function estadiasEnfermedades(){
        return $this->hasMany('App\Models\estadia_enfermedad');
    }
    
    // public function enfermedad_viral_mapas(){
    //     return $this->hasMany('App\Models\enfermedad_viral_mapa');
    // }

    public function mapas(){
        return $this->belongsToMany('App\Models\mapa');
    }

}
