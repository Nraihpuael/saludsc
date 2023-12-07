<?php

namespace App\Http\Controllers;

use App\Models\estadia_enfermedad;
use App\Models\laboratorio;
use App\Models\punto_atencion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Phpml\Regression\TimeSeries\ARIMA;

class ArimaController extends Controller
{
    public function index()
    {
        
        return view('analisis.arima');
    }

    
}
