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
            ['nombre' => 'ADMINISTRADOR', 'descripcion' => 'Rol de administrador'],
            ['nombre' => 'CENTRALIZADOR', 'descripcion' => 'Rol de asignador'],
            ['nombre' => 'TECNICO', 'descripcion' => 'Rol de técnico'],
            ['nombre' => 'ANALISTA', 'descripcion' => 'Rol de analista']
        ];

        // Insertar los registros en la tabla roles
        DB::table('roles')->insert($roles);
    }
}
