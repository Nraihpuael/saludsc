<?php

namespace Database\Seeders;

use App\Models\enfermedad_viral;
use Illuminate\Database\Seeder;

class EnfemedadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enfermedades = [
            ['nombre' => 'Dengue', 'descripcion' => 'Descripción de la Enfermedad 1'],
            ['nombre' => 'Convid-13', 'descripcion' => 'Descripción de la Enfermedad 2'],
            ['nombre' => 'Coqueluche', 'descripcion' => 'Descripción de la Enfermedad 3'],
            ['nombre' => 'Neumonia', 'descripcion' => 'Descripción de la Enfermedad 4'],
            ['nombre' => 'Influeza B', 'descripcion' => 'Descripción de la Enfermedad 5'],
            ['nombre' => 'Influeza C', 'descripcion' => 'Descripción de la Enfermedad 6'],
        ];

        foreach ($enfermedades as $enfermedad) {
            enfermedad_viral::create($enfermedad);
        }
    }
}








  



