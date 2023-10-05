<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuarioAsignacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de usuario_asignaciones
        $usuarioAsignaciones = [
            [
                'usuario_asignado_id' => 1, // ID del usuario asignado
                'usuario_asignador_id' => 2, // ID del usuario asignador
                'solicitud_id' => 1, // ID de la solicitud relacionada
            ],
            [
                'usuario_asignado_id' => 2, // ID del usuario asignado
                'usuario_asignador_id' => 1, // ID del usuario asignador
                'solicitud_id' => 2, // ID de la solicitud relacionada
            ],
            // Agregar más registros de usuario_asignaciones aquí
        ];

        // Insertar los registros en la tabla usuario_asignaciones
        DB::table('usuario_asignaciones')->insert($usuarioAsignaciones);
    }
}
