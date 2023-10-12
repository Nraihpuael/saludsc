<?php

namespace Database\Seeders;

use App\Models\brigada;
use App\Models\estadia_enfermedad;
use App\Models\punto_atencion;
use DateInterval;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class EstadiaEnfermedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $brigada = brigada::find(1);
        // $brigada->estadiasEnfermedades()->create([
        //     'user_id' => 4, //ripa
        //     'estado_id' => 2, //En Tratamiento
        //     'enfermedad_id' => 1, //Dengue
        // ]);

        // $puntoAtencion = punto_atencion::find(1);
        // $puntoAtencion->estadiasEnfermedades()->create([
        //     'user_id' => 3, // Fernando
        //     'estado_id' => 5, //Revision
        //     'enfermedad_id' => 1, //Dengue
        // ]);

        // $date = new DateTime('2022-05-01');
        // $dias = 1;
        // $date_end = new DateTime($date->format('Y-m-d'));

        // for ($i = 0; $i < 1; $i++) {
            
        //     for ($j=0; $j < random_int(0, 150); $j++) { 
        //         $dias_end = random_int(4, 10);
        //         $puntoAtencion = punto_atencion::find(1);
        //         $puntoAtencion->estadiasEnfermedades()->create([
        //             'user_id' => random_int(5, 104), // Fernando
        //             'fecha_ini' => $date,
        //             'fecha_fin' => $date_end->add(new DateInterval("P{$dias_end}D")),
        //             'estado_id' => 6, //confirmado
        //             'enfermedad_id' => 1, //Dengue
        //             'created_at' => $date
        //         ]);
        //         $date_end = new DateTime($date->format('Y-m-d'));                
        //     }
        //     $date->add(new DateInterval("P{$dias}D"));
        //     $date_end = new DateTime($date->format('Y-m-d'));
        // }
    }
}
