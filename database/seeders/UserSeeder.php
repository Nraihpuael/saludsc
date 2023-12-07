<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'ci' => 8484896,
            'name' => 'Fer',
            'email' => 'fernandocarrasc591@gmail.com',
            'password' => Hash::make('123123123'),
            'departamento' => 'Santa Cruz',
            'localidad' => 'Santa Cruz de la sierra',
            'barrio' => 'Palmar',
            'latitud' => -17.787449,
            'longitud' => -63.179280,
            'genero' => 'M',
            'fecha_nac' => '2000-07-21'
        ])->assignRole('Admin');

        User::create([
            'ci' => 8484845,
            'name' => 'Pedro Ch',
            'email' => 'pedro@gmail.com',
            'password' => Hash::make('123123123'),
            'departamento' => 'Santa Cruz',
            'localidad' => 'Santa Cruz de la sierra',
            'barrio' => 'Morita',
            'latitud' => -17.787449,
            'longitud' => -63.179280,
            'genero' => 'M',
            'fecha_nac' => '2000-07-21'
        ])->assignRole('Admin');

        User::create([
            'ci' => 8484846,
            'name' => 'Enrique Ch',
            'email' => 'pedro2@gmail.com',
            'password' => Hash::make('123123123'),
            'departamento' => 'Santa Cruz',
            'localidad' => 'Santa Cruz de la sierra',
            'barrio' => 'Argentina',
            'latitud' => -17.785599,
            'longitud' => -63.154033,
            'genero' => 'M',
            'fecha_nac' => '2000-07-21' 
        ])->assignRole('Personal Médico');

        User::create([
            'ci' => 8484847,
            'name' => 'Fernando Ona',
            'email' => 'fernando@gmail.com',
            'password' => Hash::make('123123123'),
            'departamento' => 'Santa Cruz',
            'localidad' => 'Santa Cruz de la sierra',
            'barrio' => 'Trompillo',
            'latitud' => -17.808861,
            'longitud' => -63.162674,
            'genero' => 'M',
            'fecha_nac' => '2000-05-24'
        ])->assignRole('Funcionario');

        User::create([
            'ci' => 8484848,
            'name' => 'Ricardo Ripa',
            'email' => 'ricardo@gmail.com',
            'password' => Hash::make('123123123'),
            'departamento' => 'Santa Cruz',
            'localidad' => 'Santa Cruz de la sierra',
            'barrio' => 'Polanco',
            'latitud' => -17.799673,
            'longitud' => -63.180062,
            'genero' => 'M',
            'fecha_nac' => '2000-10-14'
        ])->assignRole('Paciente');


        User::create([
            'ci' => 8484849,
            'name' => 'Manuel Torres',
            'email' => 'manuel@gmail.com',
            'password' => Hash::make('123123123'),
            'departamento' => 'Santa Cruz',
            'localidad' => 'Santa Cruz de la sierra',
            'barrio' => 'Polanco',
            'latitud' => -17.853716,
            'longitud' => -63.096956,
            'genero' => 'M',
            'fecha_nac' => '1999-04-01' 
        ])->assignRole('Personal Médico');

      
        User::create([
            'ci' => 8484850,
            'name' => 'Antonio Perez',
            'email' => 'antonio@gmail.com',
            'password' => Hash::make('123123123'),
            'departamento' => 'Santa Cruz',
            'localidad' => 'Santa Cruz de la sierra',
            'barrio' => 'Polanco',
            'latitud' => -17.864021,
            'longitud' => -63.081041,
            'genero' => 'M',
            'fecha_nac' => '1992-11-12'
        ])->assignRole('Personal Médico');

         //User::factory()->count(100)->create();
    }
     
}