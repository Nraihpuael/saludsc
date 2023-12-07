<?php

namespace Database\Seeders;

use App\Models\tipo_punto;
use Illuminate\Database\Seeder;

class TipoPuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $puntos = [
            ['nombre' => 'Hospital', 'descripcion' => 'Hospitales te atencion masivos'],
            ['nombre' => 'Punto de Atencion', 'descripcion' => 'Punto de atencion lugar'],
            ['nombre' => 'Punto Emergente', 'descripcion' => 'Punto de atencion emergente'],
        ];

        foreach ($puntos as $punto) {
            tipo_punto::create($punto);
        }
    }
}
