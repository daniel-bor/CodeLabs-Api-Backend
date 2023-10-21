<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MuestrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de muestras
        $muestras = [
            [
                'codigo' => 'SA-20231014-00001', // Código de la muestra, debe ser único
                'tipo_muestra_id' => 2, // ID del tipo de muestra relacionado
                'tipo_recipiente_id' => 1, // ID del tipo de recipiente de muestra relacionado
                'cantidad_unidades' => 5,
                'unidad_medida_id' => 1, // ID de la unidad de medida relacionada
                'solicitud_id' => 1, // ID de la solicitud relacionada
                'fecha_vencimiento' => '2023-10-31',
                'created_at' => now()->subDay(1),
                'estado' => 2
            ],
            [
                'codigo' => 'SA-20231014-00002', // Código de la muestra, debe ser único
                'tipo_muestra_id' => 2, // ID del tipo de muestra relacionado
                'tipo_recipiente_id' => 2, // ID del tipo de recipiente de muestra relacionado
                'cantidad_unidades' => 3,
                'unidad_medida_id' => 2, // ID de la unidad de medida relacionada
                'solicitud_id' => 2, // ID de la solicitud relacionada
                'fecha_vencimiento' => '2023-10-31',
                'created_at' => now()->subDay(1),
                'estado' => 1
            ],
            [
                'codigo' => 'SA-20231014-00003', // Código de la muestra, debe ser único
                'tipo_muestra_id' => 2, // ID del tipo de muestra relacionado
                'tipo_recipiente_id' => 2, // ID del tipo de recipiente de muestra relacionado
                'cantidad_unidades' => 1,
                'unidad_medida_id' => 2, // ID de la unidad de medida relacionada
                'solicitud_id' => 1, // ID de la solicitud relacionada
                'fecha_vencimiento' => '2023-10-31',
                'created_at' => now()->subDay(1),
                'estado' => 1
            ]
        ];

        // Insertar los registros en la tabla muestras
        DB::table('muestras')->insert($muestras);
    }
}
