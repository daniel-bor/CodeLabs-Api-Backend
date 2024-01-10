<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentosAnalisisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de documentos de análisis
        $documentosAnalisis = [
            [
                'muestra_id' => 1, // ID de la muestra relacionada
                'tipo_documento_analisis_id' => 1, // ID del tipo de documento de análisis relacionado
                'conclusion' => 'Informe de análisis 1',
                'estado' => true,
            ],
            [
                'muestra_id' => 2, // ID de la muestra relacionada
                'tipo_documento_analisis_id' => 2, // ID del tipo de documento de análisis relacionado
                'conclusion' => 'Informe de análisis 2',
                'estado' => true,
            ],
            // Agregar más registros de documentos de análisis aquí
        ];

        // Insertar los registros en la tabla documentos_analisis
        DB::table('documentos_analisis')->insert($documentosAnalisis);
    }
}
