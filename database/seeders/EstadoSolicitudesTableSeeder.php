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
                'nombre' => 'Creado',
                'descripcion' => 'Solicitud pendiente de procesamiento',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'Revisado',
                'descripcion' => 'Solicitud correcta para analisis',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Asociado',
                'descripcion' => 'Solicitud asociada a muestras e items',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Validado',
                'descripcion' => 'Solicitud con muestras e items correctos',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Analisis', //****************Actualizar estado al abrir solicitud
                'descripcion' => 'Solicitud asignada a un analista',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Completado',
                'descripcion' => 'Solicitud concluida para revisión',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Revision final', //****************Actualizar estado al abrir solicitud
                'descripcion' => 'Solicitud en proceso de análisis',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Finalizado',
                'descripcion' => 'Solicitud finalizada',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Cancelado',
                'descripcion' => 'Solicitud cancelada por el cliente',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Espera',
                'descripcion' => 'Solicitud en pausa para atención',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'Rechazado',
                'descripcion' => 'Solicitud rechazada por el empleado',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],


            //Estados Muestras
            [
                'nombre' => 'Creado',
                'descripcion' => 'Muestra creada en solicitud',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 2,
            ],
            [
                'nombre' => 'Asignado',
                'descripcion' => 'Muestra contiene items asignados',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 2,
            ],
            [
                'nombre' => 'Caducado',
                'descripcion' => 'Muestra caduco en solicitud',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 2,
            ],
            [
                'nombre' => 'Eliminado',
                'descripcion' => 'Muestra fue retirada de solicitud',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 2,
            ]
        ];

        // Insertar los registros en la tabla estado_solicitudes
        DB::table('estado_solicitudes')->insert($estadosSolicitudes);
    }
}
