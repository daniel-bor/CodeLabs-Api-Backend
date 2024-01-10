<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los 10 registros de roles
        $roles = [
            ['nombre' => 'Administrador', 'descripcion' => 'Rol de administrador'],
            ['nombre' => 'Revisor', 'descripcion' => 'Rol de revisor'],
            ['nombre' => 'Tecnico', 'descripcion' => 'Rol de técnico'],
            ['nombre' => 'Asignador', 'descripcion' => 'Rol de asignador'],
            ['nombre' => 'Analista', 'descripcion' => 'Rol de analista']
            // Agregar otros roles aquí
        ];

        // Insertar los registros en la tabla roles
        DB::table('roles')->insert($roles);
    }
}
