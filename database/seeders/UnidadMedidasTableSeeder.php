<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnidadMedidasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de unidades de medidas
        $unidadMedidas = [
            ['nombre' => 'Mililitros', 'descripcion' => 'Unidad de medida para líquidos',
            'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
        ],
            ['nombre' => 'Gramos', 'descripcion' => 'Unidad de medida para peso',
            'creado_por' => 1, // ID del usuario que creó este estado
            'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
        ],
            // Agregar más unidades de medidas aquí
        ];

        // Insertar los registros en la tabla unidad_medidas
        DB::table('unidad_medidas')->insert($unidadMedidas);
    }
}
