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
            ['usuario_id' => 2, 'rol_id' => 2],
            ['usuario_id' => 3, 'rol_id' => 3],
            ['usuario_id' => 4, 'rol_id' => 4],
            // Agregar otros empleados aquí
        ];

        // Insertar los registros en la tabla empleados
        DB::table('empleados')->insert($empleados);
    }
}
