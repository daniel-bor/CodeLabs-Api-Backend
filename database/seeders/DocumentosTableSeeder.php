<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de documentos
        $documentos = [
            [
                'solicitud_id' => 1, // ID de la solicitud relacionada
                'observaciones' => 'Documento de prueba 1',
                'ruta' => 'ruta_documento_1.pdf',
            ],
            [
                'solicitud_id' => 2, // ID de la solicitud relacionada
                'observaciones' => 'Documento de prueba 2',
                'ruta' => 'ruta_documento_2.pdf',
            ],
            // Agregar más registros de documentos aquí
        ];

        // Insertar los registros en la tabla documentos
        DB::table('documentos')->insert($documentos);
    }
}
