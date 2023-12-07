<?php

namespace Database\Seeders;

use App\Models\sintoma;
use Illuminate\Database\Seeder;

class SintomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        sintoma::create([
            'nombre' => 'Dolor de Cabeza',
            'descripcion' => 'Dolor de cabeza detalle sanamente'
        ]);

        sintoma::create([
            'nombre' => 'Dolor de Garganta',
            'descripcion' => 'Dolor de garganta detalle sanamente'
        ]);

        sintoma::create([
            'nombre' => 'Resfrío',
            'descripcion' => 'Resfrío detalle sanamente'
        ]);

    }
}
