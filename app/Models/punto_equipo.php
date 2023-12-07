<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class punto_equipo extends Model
{
    use HasFactory;
    protected $table = 'punto_equipo';
    protected $fillable = ['equipo_id','punto_atencion_id','cantidad'];

}
