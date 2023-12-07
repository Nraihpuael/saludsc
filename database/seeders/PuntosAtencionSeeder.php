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
            ['nombre' => 'C.S. HAMACAS',        'red' => 'NORTE', 'distrito' => '2', 'ubicacion' => 'B/  Hamacas C/ Rio Blanco 3105 entre C/11 y Av. Alemana',                  'id_tipo_punto' => 1, 'latitud' => -17.7564159, 'longitud' => -63.1692867],
            ['nombre' => 'C.S. LAZARETO',       'red' => 'NORTE', 'distrito' => '2', 'ubicacion' => 'B/ Lazareto  C/ Corumbá esq. C/ Pailón',                                   'id_tipo_punto' => 1, 'latitud' => -17.7837784, 'longitud' => -63.1599025],
            ['nombre' => 'C.S. SANTA ISABEL',   'red' => 'NORTE', 'distrito' => '2', 'ubicacion' => 'Av. Paraguá pasando el tercer anillo calle Nº 6  lado Colegio  Wenceslao', 'id_tipo_punto' => 1, 'latitud' => -17.7694663, 'longitud' => -63.150745],
            
            
            ['nombre' => 'C.S. ANITA SUÁREZ DE LEIGUE',        'red' => 'NORTE', 'distrito' => '5', 'ubicacion' => 'Av. Banzer Km.4½ al norte detrás Coop. Humberto Leigue',                                    'id_tipo_punto' => 1, 'latitud' => -17.737104, 'longitud' => -63.1717813],
            ['nombre' => 'C.S. PALOS VERDES',                  'red' => 'NORTE', 'distrito' => '5', 'ubicacion' => ' U.V. 194 frente al Condominio Los Cedros, entre 8vo y 9no anillo, barrio Palos Verdes',    'id_tipo_punto' => 1, 'latitud' => -17.7127372, 'longitud' => -63.1449302],
            ['nombre' => 'C.S. POCHOLA TRAPERO',               'red' => 'NORTE', 'distrito' => '5', 'ubicacion' => ' B/ Claracuta lado Col. Vertino Candia',                                                    'id_tipo_punto' => 1, 'latitud' => -17.7127372, 'longitud' => -63.1449302],
            ['nombre' => 'C.S. PALOS VERDES',                  'red' => 'NORTE', 'distrito' => '5', 'ubicacion' => ' U.V. 194 frente al Condominio Los Cedros, entre 8vo y 9no anillo, barrio Palos Verdes',    'id_tipo_punto' => 1, 'latitud' => -17.7127372, 'longitud' => -63.1449302],
            ['nombre' => 'C.S. PALOS VERDES',                  'red' => 'NORTE', 'distrito' => '5', 'ubicacion' => ' U.V. 194 frente al Condominio Los Cedros, entre 8vo y 9no anillo, barrio Palos Verdes',    'id_tipo_punto' => 1, 'latitud' => -17.7127372, 'longitud' => -63.1449302],

        ];
        
        foreach ($puntos as $punto) {
            punto_atencion::create($punto);
        }
    }
}
