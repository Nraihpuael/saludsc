<?php

namespace Database\Seeders;

use App\Models\lugar;
use Illuminate\Database\Seeder;

class LugarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        lugar::create([
            'name' => 'Los Pozos',
            'descripcion' => 'La zona 1 es un buen lugar donde las personas conviven sanamente'
        ]);

        lugar::create([
            'name' => 'Plan 3K',
            'descripcion' => 'La zona 2 es un buen lugar donde las personas conviven sanamente'
        ]);

        lugar::create([
            'name' => 'Av paurito',
            'descripcion' => 'La zona 3 es un buen lugar donde las personas conviven sanamente'
        ]);

        
    }
}
