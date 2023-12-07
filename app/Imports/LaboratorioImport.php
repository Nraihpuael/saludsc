<?php

namespace App\Imports;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Laboratorio;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LaboratorioImport implements ToModel
{
    private $startImport = false; // Indica cuando iniciar

    public function model(array $row)
    {

        $fechaIngresoIndex = 0; // Index of 'ingreso' column
        $fechaInicioIndex = 12;  // Index of 'f_inicio' column
        $fechaTomaIndex = 14;  // Index of 'f_inicio' column

        //Condicion de salida cuando termina la tabla
        if (!isset($row[$fechaIngresoIndex])) {
            $this->startImport= false;
            return null;
        }

        if ($this->startImport) {

            $row[$fechaIngresoIndex] = $this->convertToDate($row[$fechaIngresoIndex]);
            $row[$fechaInicioIndex] = $this->convertToDate($row[$fechaInicioIndex]);
            $row[$fechaTomaIndex] = $this->convertToDate($row[$fechaTomaIndex]);

            //dd($row);
            $laboratorio = new Laboratorio([
                'fecha_ingreso' => $row[$fechaIngresoIndex],
                'ap_paterno' => $row[2], // Adjust the indices for other columns as needed
                'name' => $row[3],      
                'genero' => $row[4],
                'edad' => $row[5],
                'departamento' => $row[6],
                'localidad' => $row[7],
                'barrio' => $row[8],
                'telefono' => $row[9],
                'hospitalizado' => $row[10],
                'punto_atencion' => $row[11],
                'fecha_ini' => $row[$fechaInicioIndex],
                'sem' => $row[13],
                'fecha_toma' => $row[$fechaTomaIndex],
                'dias' => $row[15],
                'resultados' => $row[16],
                'observaciones' => $row[17]
            ]);
            //dd($laboratorio);
            $laboratorio->save(); // Save the model to the database

            return $laboratorio; // Return the saved model

        } else {
            // Condicion de inicio de la tabla
            if ($row[$fechaIngresoIndex] == "INGRESO" && $row[1] == "CÓDIGO") {
                $this->startImport = true; 
                //dd($row);
            }
            return null; // Salta filas hasta encontrar 'ingreso' 
        }
    }

    private function convertToDate($value)
    {
        if (is_int($value)) {
            $fecha = Date::excelToDateTimeObject($value)->format('d/m/Y');
            $fecha = Carbon::createFromFormat('d/m/Y', $fecha)->format('Y-m-d');
            //dd($fecha);
            return $fecha;

        } elseif (is_string($value)) {
            if (stripos($value, ' ') !== false) {
                return null;
            }
            return $value;
        }
        return null; 
    }
}