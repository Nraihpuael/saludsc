<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estadia_enfermedad_sintoma extends Model
{
    use HasFactory;
    protected $fillable = ['estadia_enfermedad_id','sintoma_id'];

}
