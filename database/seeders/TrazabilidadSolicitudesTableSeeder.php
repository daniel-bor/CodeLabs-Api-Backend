<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TrazabilidadSolicitudesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de trazabilidad_solicitudes
        $trazabilidadSolicitudes = [
            [
                'solicitud_id' => 1, // ID de la solicitud relacionada
                'estado_solicitud_id' => 1, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 1',
            ],
            [
                'solicitud_id' => 2, // ID de la solicitud relacionada
                'estado_solicitud_id' => 2, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 2',
            ],
            // Agregar más registros de trazabilidad_solicitudes aquí
        ];

        // Insertar los registros en la tabla trazabilidad_solicitudes
        DB::table('trazabilidad_solicitudes')->insert($trazabilidadSolicitudes);
    }
}
