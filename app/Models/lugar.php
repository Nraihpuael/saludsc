<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lugar extends Model
{
    use HasFactory;

    public function brigadas(){
       return $this->hasMany('App\Models\brigada');
    }

}
