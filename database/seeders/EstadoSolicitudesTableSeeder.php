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
                'nombre' => 'CREADO',
                'descripcion' => 'Solicitud pendiente de procesamiento',
                'empleado_rol' => 2, // ID del rol de empleado que debe atender esta solicitud
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'REVISADO',
                'descripcion' => 'Solicitud correcta para analisis',
                'empleado_rol' => 3,
                'creado_por' => 2, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'INICIADO',
                'descripcion' => 'Solicitud asociada a muestras e items',
                'empleado_rol' => 3,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'ASOCIADO',
                'descripcion' => 'Solicitud asociada a muestras e items',
                'empleado_rol' => 2,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'VALIDADO',
                'descripcion' => 'Solicitud con muestras e items correctos',
                'empleado_rol' => 4,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'ANALISIS', //****************Actualizar estado al abrir solicitud
                'descripcion' => 'Solicitud asignada a un analista',
                'empleado_rol' => 4,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'COMPLETADO',
                'descripcion' => 'Solicitud concluida para revisión',
                'empleado_rol' => 2,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'REVISION_FINAL', //****************Actualizar estado al abrir solicitud
                'descripcion' => 'Solicitud en proceso de análisis',
                'empleado_rol' => 2,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'FINALIZADO',
                'descripcion' => 'Solicitud finalizada',
                'empleado_rol' => 2,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'CANCELADO',
                'descripcion' => 'Solicitud cancelada por el cliente',
                'empleado_rol' => 1,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'ESPERA',
                'descripcion' => 'Solicitud en pausa para atención',
                'empleado_rol' => null,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            [
                'nombre' => 'RECHAZADO',
                'descripcion' => 'Solicitud rechazada por el empleado',
                'empleado_rol' => null,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1,
            ],


            //Estados Muestras
            [
                'nombre' => 'CREADO',
                'descripcion' => 'Muestra creada en solicitud',
                'empleado_rol' => null,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 2,
            ],
            [
                'nombre' => 'ASIGNADO',
                'descripcion' => 'Muestra contiene items asignados',
                'empleado_rol' => null,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 2,
            ],
            [
                'nombre' => 'CADUCADO',
                'descripcion' => 'Muestra caduco en solicitud',
                'empleado_rol' => null,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 2,
            ],
            [
                'nombre' => 'ELIMINADO',
                'descripcion' => 'Muestra fue retirada de solicitud',
                'empleado_rol' => null,
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 2,
            ]
        ];

        $estadosSiguienteAnterior = [
            [
                'id' => 1,
                'estado_anterior' => null,
                'estado_siguiente' => 2
            ],
            [
                'id' => 2,
                'estado_anterior' => 1,
                'estado_siguiente' => 3
            ],
            [
                'id' => 3,
                'estado_anterior' => 2,
                'estado_siguiente' => 4
            ],
            [
                'id' => 4,
                'estado_anterior' => 3,
                'estado_siguiente' => 5
            ],
            [
                'id' => 5,
                'estado_anterior' => 4,
                'estado_siguiente' => 6
            ],
            [
                'id' => 6,
                'estado_anterior' => 5,
                'estado_siguiente' => 7
            ],
            [
                'id' => 7,
                'estado_anterior' => 6,
                'estado_siguiente' => 8
            ],
            [
                'id' => 8,
                'estado_anterior' => 7,
                'estado_siguiente' => 9
            ],
            [
                'id' => 9,
                'estado_anterior' => 8,
                'estado_siguiente' => null
            ]
        ];

        DB::beginTransaction(); // Inicia la transacción

        try {
            // Insertar los registros iniciales en la tabla 'estado_solicitudes'
            DB::table('estado_solicitudes')->insert($estadosSolicitudes);

            // Actualizar los registros en la tabla 'estado_solicitudes' con los datos de 'estado_anterior' y 'estado_siguiente'
            foreach ($estadosSiguienteAnterior as $estado) {
                DB::table('estado_solicitudes')
                    ->where('id', $estado['id'])
                    ->update([
                        'estado_anterior' => $estado['estado_anterior'],
                        'estado_siguiente' => $estado['estado_siguiente'],
                    ]);
            }

            DB::commit(); // Confirma la transacción si todo fue exitoso
        } catch (\Exception $e) {
            DB::rollback(); // Revierte la transacción en caso de error
            throw $e; // Puedes manejar el error o lanzar una excepción según tus necesidades
        }
    }
}
