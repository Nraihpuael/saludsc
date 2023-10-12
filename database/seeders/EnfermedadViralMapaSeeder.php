<?php

namespace Database\Seeders;

use App\Models\enfermedad_viral_mapa;
use Illuminate\Database\Seeder;

class EnfermedadViralMapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        enfermedad_viral_mapa::create([
            'mapa_id' => 1,
            'enfermedad_viral_id' => 1
        ]);

        enfermedad_viral_mapa::create([
            'mapa_id' => 1,
            'enfermedad_viral_id' => 4
        ]);

        enfermedad_viral_mapa::create([
            'mapa_id' => 2,
            'enfermedad_viral_id' => 2
        ]);

        enfermedad_viral_mapa::create([
            'mapa_id' => 2,
            'enfermedad_viral_id' => 3
        ]);

        enfermedad_viral_mapa::create([
            'mapa_id' => 2,
            'enfermedad_viral_id' => 6
        ]);

    }
}
