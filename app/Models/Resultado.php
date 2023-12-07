<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;
    protected $fillable = ['titulo','descripcion','atencion_id'];

    public function atencion(){
        return $this->belongsTo('App\Models\Atencion');
    }

}
