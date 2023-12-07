<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitud extends Model
{
    use HasFactory;
    protected $fillable = ['titulo','punto_atencion_id','estado','descripcion','user_id'];

    public function paciente(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function punto_atencion(){
        return $this->belongsTo('App\Models\punto_atencion','punto_atencion_id');
    }

}
