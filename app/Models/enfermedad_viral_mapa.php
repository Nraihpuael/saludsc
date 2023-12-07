<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enfermedad_viral_mapa extends Model
{
    use HasFactory;
    protected $fillable = ['mapa_id','enfermedad_viral_id'];

    // public function mapa(){
    //     return $this->belongsTo('App\Models\mapa');
    // }

    // public function enfermedad_viral(){
    //     return $this->belongsTo('App\Models\enfermedad_viral');
    // }

}
