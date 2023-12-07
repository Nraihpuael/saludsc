<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trabajo extends Model
{
    use HasFactory;

    protected $fillable = ['cargo', 'fecha_ini', 'fecha_fin', 'estado', 'user_id', 'punto_atencion_id']; 

    public function medico(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
