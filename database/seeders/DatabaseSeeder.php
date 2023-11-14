<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TipoPuntoSeeder::class);
        $this->call(PuntosAtencionSeeder::class);
        $this->call(EnfemedadesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(LugarSeeder::class);
        $this->call(BrigadaSeeder::class);
        $this->call(EstadiaEnfermedadSeeder::class);
        $this->call(SintomaSeeder::class);
        // $this->call(EnfermedadViralMapaSeeder::class);

    }
}
