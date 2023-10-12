<?php

namespace Database\Seeders;

use App\Models\estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        estado::create([
            'estado' => 'Sospechoso',
            'descripcion' => 'El paciente fue revisado y presenta sospecha de la enfermedad dianogticada'
        ]);

        estado::create([
            'estado' => 'En Tratamiento',
            'descripcion' => 'El paciente fue revisado y presenta la enfermedad dianogticada'
        ]);

        estado::create([
            'estado' => 'En Recuperacion',
            'descripcion' => 'El paciente fue revisado y presenta mejoria en la enfermedad dianogticada'
        ]);

        estado::create([
            'estado' => 'Recuperado',
            'descripcion' => 'El paciente fue revisado y no presenta la enfermedad dianogticada'
        ]);

        estado::create([
            'estado' => 'En Revision',
            'descripcion' => 'El paciente fue revisado y no presenta la enfermedad dianogticada, pero esta en revison aun'
        ]);

        estado::create([
            'estado' => 'Confirmado',
            'descripcion' => 'El paciente fue revisado y presenta la enfermedad dianogticada'
        ]);

    }
}
