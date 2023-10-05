<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los 10 registros de empleados
        $empleados = [
            ['usuario_id' => 1, 'rol_id' => 1], // Ejemplo de asignación de usuario y rol
            // Agregar otros empleados aquí
        ];

        // Insertar los registros en la tabla empleados
        DB::table('empleados')->insert($empleados);
    }
}
