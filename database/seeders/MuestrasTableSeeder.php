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
                'tipo_muestra_id' => 1, // ID del tipo de muestra relacionado
                'tipo_recipiente_muestra_id' => 1, // ID del tipo de recipiente de muestra relacionado
                'cantidad_unidades' => 5,
                'unidad_medida_id' => 1, // ID de la unidad de medida relacionada
                'etiqueta' => 'Muestra 1',
                'solicitud_id' => 1, // ID de la solicitud relacionada
                'dia_vencimiento' => '2023-12-31',
                'estado' => true,
                'created_at' => now()->subDay(1),
            ],
            [
                'tipo_muestra_id' => 2, // ID del tipo de muestra relacionado
                'tipo_recipiente_muestra_id' => 2, // ID del tipo de recipiente de muestra relacionado
                'cantidad_unidades' => 3,
                'unidad_medida_id' => 2, // ID de la unidad de medida relacionada
                'etiqueta' => 'Muestra 2',
                'solicitud_id' => 2, // ID de la solicitud relacionada
                'dia_vencimiento' => '2023-12-31',
                'estado' => true,
                'created_at' => now()->subDay(1),
            ],
            // Agregar más registros de muestras aquí
        ];

        // Insertar los registros en la tabla muestras
        DB::table('muestras')->insert($muestras);
    }
}
