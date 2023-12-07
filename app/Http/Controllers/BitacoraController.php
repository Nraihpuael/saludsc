<?php

namespace App\Http\Controllers;

use App\Exports\BitacoraExport;
use App\Models\bitacora;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bitacoras = bitacora::orderBy('created_at', 'desc')->paginate(20);
        return view('bitacora.index', compact('bitacoras'));
    }

    public function excel(){
        return Excel::download(new BitacoraExport, 'bitacora.xlsx');
    }
}
