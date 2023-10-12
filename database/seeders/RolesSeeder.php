<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'Admin',
        ]);

        $funcion = Role::create([
            'name' => 'Funcionario',
        ]);

        $person = Role::create([
            'name' => 'Personal Médico',
        ]);
        
        $pacien = Role::create([
            'name' => 'Paciente',
        ]);
        
        Permission::create(['name' => 'SideBar Usuarios'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'ver adminis'])->assignRole([$admin]);
        Permission::create(['name' => 'ver funcionarios'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'ver pacientes'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'ver personal medico'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'crear admin'])->assignRole([$admin]);
        Permission::create(['name' => 'crear funcionario'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'crear personal medico'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'crear paciente'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'agregar usuario'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'editar usuario'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'cambiar estado usuario'])->assignRole([$admin, $funcion]);
        
        Permission::create(['name' => 'asignar solicitud'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'ver solicitud'])->assignRole([$admin, $funcion, $pacien, $person]);
        Permission::create(['name' => 'eliminar solicitud'])->assignRole([$admin, $funcion, $pacien]);
        
        Permission::create(['name' => 'agregar atencion'])->assignRole([$admin, $pacien]);
        Permission::create(['name' => 'ver resultados'])->assignRole([$admin, $pacien, $person]);
        Permission::create(['name' => 'eliminar atencion'])->assignRole([$admin, $pacien, $person]);
        Permission::create(['name' => 'ver atencion'])->assignRole([$admin, $pacien, $person, $funcion]);


        Permission::create(['name' => 'SideBar Admin'])->assignRole([$admin]);
        Permission::create(['name' => 'SideBar Brigada'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'SideBar Punto'])->assignRole([$admin, $person, $funcion]);
        Permission::create(['name' => 'SideBar atencion'])->assignRole([$admin, $pacien, $person]);
        Permission::create(['name' => 'SideBar enfermedades'])->assignRole([$admin, $person]);
        Permission::create(['name' => 'SideBar analisis'])->assignRole([$admin, $funcion]);
        Permission::create(['name' => 'SideBar bitacora'])->assignRole([$admin]);

    }
}
