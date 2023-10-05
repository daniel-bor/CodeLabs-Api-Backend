<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SolicitudesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de solicitudes
        $solicitudes = [
            [
                'tipo_soporte_id' => 1, // ID del tipo de soporte
                'no_soporte' => 'SOL-001',
                'descripcion' => 'Descripción de la solicitud 1',
                'fecha_recepcion' => '2023-10-04',
                'cliente_id' => 1, // ID del cliente relacionado
                'longitud' => 12345,
                'latitud' => 67890,
            ],
            [
                'tipo_soporte_id' => 2, // ID del tipo de soporte
                'no_soporte' => 'SOL-002',
                'descripcion' => 'Descripción de la solicitud 2',
                'fecha_recepcion' => '2023-10-05',
                'cliente_id' => 2, // ID del cliente relacionado
                'longitud' => 54321,
                'latitud' => 98765,
            ],
            // Agregar más registros de solicitudes aquí
        ];

        // Insertar los registros en la tabla solicitudes
        DB::table('solicitudes')->insert($solicitudes);
    }
}
