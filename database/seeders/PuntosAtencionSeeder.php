<?php

namespace Database\Seeders;

use App\Models\punto_atencion;
use Illuminate\Database\Seeder;

class PuntosAtencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $puntos = [
            ['nombre' => 'Hospital San Juan de Dios', 'ubicacion' => 'Calle Adolfo Ballivián, Santa Cruz de la Sierra', 'id_tipo_punto' => 1, 'latitud' => -17.761937, 'longitud' => -63.199138],
            ['nombre' => 'Hospital Japonés', 'ubicacion' => 'Avenida Cañoto, Santa Cruz de la Sierra', 'id_tipo_punto' => 1, 'latitud' => -17.792746 , 'longitud' => -63.204475],
            ['nombre' => 'Hospital Obrero Nº 2', 'ubicacion' => 'Calle Potosí, Santa Cruz de la Sierra', 'id_tipo_punto' => 1, 'latitud' => -17.771149, 'longitud' => -63.099407],
            ['nombre' => 'Caja Petrolera de Salud', 'ubicacion' => 'Avenida Cristo Redentor, Santa Cruz de la Sierra', 'id_tipo_punto' => 1, 'latitud' => -17.827258 , 'longitud' => -63.170796],
            ['nombre' => 'Atencion Dr. Jacinto', 'ubicacion' => 'Av. German Bush, calle 5 oeste', 'id_tipo_punto' => 2, 'latitud' => -17.740137, 'longitud' => -63.143228],
        ];
        
        foreach ($puntos as $punto) {
            punto_atencion::create($punto);
        }
    }
}
