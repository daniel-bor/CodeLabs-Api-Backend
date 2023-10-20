<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EstadoSolicitudesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de estados de solicitudes
        $estadosSolicitudes = [
            [
                'nombre' => 'Creada',
                'descripcion' => 'Solicitud pendiente de procesamiento',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'Enviada',
                'descripcion' => 'Solicitud en proceso de análisis',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Recibida',
                'descripcion' => 'Solicitud en proceso de análisis',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Asignada',
                'descripcion' => 'Solicitud en proceso de análisis',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'En Analisis',
                'descripcion' => 'Solicitud en proceso de análisis',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Espera',
                'descripcion' => 'Solicitud en proceso de análisis',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Revision',
                'descripcion' => 'Solicitud en proceso de análisis',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Finalizado',
                'descripcion' => 'Solicitud en proceso de análisis',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Rechazada',
                'descripcion' => 'Solicitud en proceso de análisis',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],


            //Estados Muestras
            [
                'nombre' => 'Creada',
                'descripcion' => 'Muestra creada en solicitud',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Asignada',
                'descripcion' => 'Muestra contiene items asignados',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Caducada',
                'descripcion' => 'Muestra caduco en solicitud',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Eliminada',
                'descripcion' => 'Muestra fue retirada de solicitud',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ]
        ];

        // Insertar los registros en la tabla estado_solicitudes
        DB::table('estado_solicitudes')->insert($estadosSolicitudes);
    }
}
