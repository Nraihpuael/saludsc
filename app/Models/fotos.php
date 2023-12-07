<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fotos extends Model
{
    use HasFactory;

    protected $fillable = ['uri'];
    //Relacion polimorfica
    
    public function fotosable(){
        return $this->morphTo();
    }

}
