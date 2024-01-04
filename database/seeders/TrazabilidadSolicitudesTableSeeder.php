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
                'usuario_asignador_id' => null,
                'usuario_asignado_id' => null,
                'created_at' => now()->subDays(2)
            ],
            [
                'solicitud_id' => 1, // ID de la solicitud relacionada
                'estado_solicitud_id' => 2, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 2',
                'usuario_asignador_id' => 4,
                'usuario_asignado_id' => 5,
                'created_at' => now()->subDays(1)
            ],
            [
                'solicitud_id' => 1, // ID de la solicitud relacionada
                'estado_solicitud_id' => 3, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 3',
                'usuario_asignador_id' => 5,
                'usuario_asignado_id' => 5,
                'created_at' => now()->subDays(1)
            ],
            [
                'solicitud_id' => 2, // ID de la solicitud relacionada
                'estado_solicitud_id' => 1, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 2',
                'usuario_asignador_id' => null,
                'usuario_asignado_id' => 4,
                'created_at' => now()->subDays(1)
            ],
            [
                'solicitud_id' => 2, // ID de la solicitud relacionada
                'estado_solicitud_id' => 2, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 2',
                'usuario_asignador_id' => 4,
                'usuario_asignado_id' => 5,
                'created_at' => now()
            ],
            [
                'solicitud_id' => 2, // ID de la solicitud relacionada
                'estado_solicitud_id' => 3, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 3',
                'usuario_asignador_id' => 5,
                'usuario_asignado_id' => 5,
                'created_at' => now()
            ],
            // Agregar más registros de trazabilidad_solicitudes aquí
            [
                'solicitud_id' => 3, // ID de la solicitud relacionada
                'estado_solicitud_id' => 2, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 3',
                'usuario_asignador_id' => null,
                'usuario_asignado_id' => 4,
                'created_at' => now()->subDays(1)
            ],
            [
                'solicitud_id' => 4, // ID de la solicitud relacionada
                'estado_solicitud_id' => 1, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 4',
                'usuario_asignador_id' => null,
                'usuario_asignado_id' => 4,
                'created_at' => now()->subDays(1)
            ],
            [
                'solicitud_id' => 5, // ID de la solicitud relacionada
                'estado_solicitud_id' => 1, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 5',
                'usuario_asignador_id' => null,
                'usuario_asignado_id' => 4,
                'created_at' => now()->subDays(1)
            ],
            [
                'solicitud_id' => 6, // ID de la solicitud relacionada
                'estado_solicitud_id' => 1, // ID del estado de la solicitud relacionado
                'observaciones' => 'Observación 6',
                'usuario_asignador_id' => null,
                'usuario_asignado_id' => 4,
                'created_at' => now()
            ]
        ];

        // Insertar los registros en la tabla trazabilidad_solicitudes
        DB::table('trazabilidad_solicitudes')->insert($trazabilidadSolicitudes);
    }
}
