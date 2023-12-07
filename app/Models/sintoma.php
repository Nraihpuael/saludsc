<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sintoma extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion'];

    public function estadia_enfermedads(){
        return $this->belongsToMany('App\Models\estadia_enfermedad');
    }

    
}
