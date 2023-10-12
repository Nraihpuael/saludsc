<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion','cantidad'];

    public function punto_atencions(){
        return $this->belongsToMany('App\Models\punto_atencion','punto_equipo');
    }
    
}
