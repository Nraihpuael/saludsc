<?php

namespace Database\Seeders;

use App\Models\mapa;
use Illuminate\Database\Seeder;

class MapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        mapa::create([
            'name' => 'Dengue y Neumonia',
            'detalle' => 'El mapa contiene las enfermedades de dengue y de neumoni'
        ]);

        mapa::create([
            'name' => 'Covid, Coqueluche e Influeza C',
            'detalle' => 'El mapa contiene las enfermedades de dengue y de neumoni'
        ]);

    }
}
