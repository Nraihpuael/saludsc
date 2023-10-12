<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mapa extends Model
{
    use HasFactory;
    protected $fillable = ['name','detalle','latitud','longitud'];

    // public function enfermedad_viral_mapas(){
    //     return $this->hasMany('App\Models\enfermedad_viral_mapa');
    // }

    public function enfermedad_virals(){
        return $this->belongsToMany('App\Models\enfermedad_viral');
    }

}
