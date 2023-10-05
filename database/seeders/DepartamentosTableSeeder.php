<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de departamentos
        $departamentos = [
            [
                'nombre' => 'Departamento 1',
                'descripcion' => 'Descripción del departamento 1',
                'creado_por' => 1, // ID del usuario que creó este departamento
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'Departamento 2',
                'descripcion' => 'Descripción del departamento 2',
                'creado_por' => 2, // ID del usuario que creó este departamento
                'estado' => 1,
            ],
            // Agregar más departamentos aquí
        ];

        // Insertar los registros en la tabla departamentos
        DB::table('departamentos')->insert($departamentos);
    }
}
