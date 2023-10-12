<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estado extends Model
{
    use HasFactory;

    public function estadiasEnfermedades(){
        return $this->hasMany('App\Models\estadia_enfermedad');
    }
    
}
