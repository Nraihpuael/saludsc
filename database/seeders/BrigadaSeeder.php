<?php

namespace Database\Seeders;

use App\Models\brigada;
use Illuminate\Database\Seeder;

class BrigadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        brigada::create([
            'name' => 'Brigada 1',
            'lugar_id' => 1 // zona 1
        ]);

        brigada::create([
            'name' => 'Brigada 2',
            'lugar_id' => 2 // zona 2
        ]);

        brigada::create([
            'name' => 'Brigada 3',
            'lugar_id' => 3 // zona 3
        ]);

    }
}
