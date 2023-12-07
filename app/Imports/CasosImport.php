<?php

namespace App\Imports;

use App\Models\estadia_enfermedad;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\punto_atencion;
use App\Models\tipo_punto;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CasosImport implements ToModel, WithChunkReading
{
    private $startImport = false; // Indica cuando iniciar

    public function model(array $row)
    {
        $fechaIngresoIndex = 0;
        

        //Condicion de salida cuando termina la tabla
        if (!isset($row[$fechaIngresoIndex])) {
            $this->startImport= false;
            return null;
        }

        try {
            if ($this->startImport) { 
                $explote = explode(' ', $row[9]);
                
                $punto_atencion = end($explote);
                $result = punto_atencion::whereRaw('UPPER(nombre) LIKE ?', ['%' . strtoupper($punto_atencion) . '%'])->pluck('id')->first();
                
                if($result != null){
                    $sexo = (strtolower(substr($row[2], 0, 1)) == 'm') ? 'M' : ((strtolower(substr($row[2], 0, 1)) == 'f') ? 'F' : null);            
                    $faker = Faker::create();
                    do {
                        $ci = $faker->randomNumber(8);
                    } while (User::where('ci', $ci)->exists());
        
                    $row[$fechaIngresoIndex] = $this->convertToDate($row[$fechaIngresoIndex]);           
                    
                    if (strlen($row[7]) > 15) {
                        $row[7] = null;
                    }
                    
                    $user = new User([
                        'ci' => $ci,
                        'name' => $faker->firstName,
                        'password' => bcrypt('password'),
                        'ap_paterno' => $faker->lastName,
                        'ap_materno' => $faker->lastName,
                        'departamento' => 'Santa Cruz',
                        'localidad' => 'Santa Cruz de la sierra',                    
                        'barrio' => $row[6],
                        'telefono' => $row[7],
                        'genero' => $sexo,
                        
                        //'red' => $row[1],

                        //'distrito' => $row[$fechaIngresoIndex], // Adjust the indices for other columns as needed
                        //'ubicacion' => $row[4],      
                    ]);
                    $user->save(); // Save the model to the database
                    $role = 'Paciente';
                    $user->assignRole($role);

                    $estadia = new estadia_enfermedad([
                        'fecha_ini'=> $row[$fechaIngresoIndex],
                        'user_id' => $user->id,
                        'estado_id'=> 6,
                        'enfermedad_id'=> 1,
                        'estadia_id'=> $result,
                    ]);
                    $estadia->save();
                    
                    return $user; // Return the saved model
                }else {
                    return null;
                }
            }else {
                if ($row[$fechaIngresoIndex] == "INGRESO" && $row[1] == "CODIGO") {
                    $this->startImport = true; 
                    //dd($row);
                }
                return null;
            }

        } catch (\Exception $e) {
            return null; // Skip the current row and proceed with the next one
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

    public function chunkSize(): int
    {
        return 2000;
    }
}