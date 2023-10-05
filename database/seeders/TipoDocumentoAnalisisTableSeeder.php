<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoDocumentoAnalisisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de tipos de documentos de análisis
        $tiposDocumentos = [
            [
                'nombre' => 'Informe de Laboratorio',
                'descripcion' => 'Informe de resultados de análisis de laboratorio',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'Certificado de Calidad',
                'descripcion' => 'Certificado que asegura la calidad del producto',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            // Agregar más tipos de documentos aquí
        ];

        // Insertar los registros en la tabla tipo_documento_analisis
        DB::table('tipo_documento_analisis')->insert($tiposDocumentos);
    }
}
