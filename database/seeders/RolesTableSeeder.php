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
            ['nombre' => 'Usuario', 'descripcion' => 'Rol de usuario'],
            // Agregar otros roles aquí
        ];

        // Insertar los registros en la tabla roles
        DB::table('roles')->insert($roles);
    }
}
