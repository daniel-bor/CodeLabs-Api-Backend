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
                'nombre' => 'Pendiente',
                'descripcion' => 'Solicitud pendiente de procesamiento',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'En proceso',
                'descripcion' => 'Solicitud en proceso de análisis',
                'creado_por' => 2, // ID del usuario que creó este estado
                'estado' => 1,
            ],
            // Agregar más estados de solicitudes aquí
        ];

        // Insertar los registros en la tabla estado_solicitudes
        DB::table('estado_solicitudes')->insert($estadosSolicitudes);
    }
}
