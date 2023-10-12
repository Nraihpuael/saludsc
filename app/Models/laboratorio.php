<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laboratorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_ingreso',
        'ap_paterno',
        'name',
        'genero',
        'edad',
        'departamento',
        'localidad',
        'barrio',
        'telefono',
        'hospitalizado',
        'punto_atencion',
        'fecha_ini',
        'sem',
        'fecha_toma',
        'dias',
        'resultados',
        'observaciones',
        'estadia_enfermedad_id',
    ];

    public function estadia_enfermedad(){
        return $this->belongsTo('App\Models\estadia_enfermedad');
    }
}