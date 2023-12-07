<?php

namespace App\Imports;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\punto_atencion;
use App\Models\tipo_punto;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PuntoAtencionImport implements ToModel
{
    private $startImport = false; // Indica cuando iniciar

    public function model(array $row)
    {
        $inicio = 0;
        //dd($row);

        //Condicion de salida cuando termina la tabla
        if (!isset($row[$inicio])) {
            $this->startImport= false;
            return null;
        }

        if ($this->startImport) {
            $coordinates = explode(',', $row[3]);
            //dd($coordinates);
            $punto = new punto_atencion([
                'nombre' => $row[2],
                'red' => $row[1],
                'distrito' => $row[$inicio], // Adjust the indices for other columns as needed
                'ubicacion' => $row[4],      
                'longitud' => $coordinates[1],
                'latitud' => $coordinates[0],
                'telefono' => $row[5],
                'id_tipo_punto' => 1,
            ]);
           
            $punto->save(); // Save the model to the databases            
            return $punto; // Return the saved model
           
        }else {
            if ($row[$inicio] == "DISTRITO" && $row[1] == "RED") {
                $this->startImport = true; 
                //dd($row);
            }
            return null;
        }
    }

}