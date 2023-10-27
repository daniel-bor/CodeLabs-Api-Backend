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
                'codigo' => 'EX-07102023-86372',
                'no_soporte' => 'SOL-001',
                'descripcion' => 'Descripción de la solicitud 1',
                'cliente_id' => 1, // ID del cliente relacionado
                'direccion' => 'Dirección de la solicitud 1', // Agregamos la dirección
                'longitud' => "12345",
                'latitud' => "67890",
                'estado' => 1,
                'created_at' => now()->subDays(2)
            ],
            [
                'tipo_soporte_id' => 2, // ID del tipo de soporte
                'codigo' => 'EX-07102023-86373',
                'no_soporte' => 'SOL-002',
                'descripcion' => 'Descripción de la solicitud 2',
                'cliente_id' => 2, // ID del cliente relacionado
                'direccion' => 'Dirección de la solicitud 2', // Agregamos la dirección
                'longitud' => "54321",
                'latitud' => "98765",
                'estado' => 2,
                'created_at' => now()
            ],
            [
                'tipo_soporte_id' => 2, // ID del tipo de soporte
                'codigo' => 'EX-07102023-18736',
                'no_soporte' => 'SOL-003',
                'descripcion' => 'Descripción de la solicitud 3',
                'cliente_id' => 1, // ID del cliente relacionado
                'direccion' => 'Dirección de la solicitud 3', // Agregamos la dirección
                'longitud' => "54321",
                'latitud' => "98765",
                'estado' => 2,
                'created_at' => now(),
            ],

            //Solicitudes de prueba
            [
                'tipo_soporte_id' => 2, // ID del tipo de soporte
                'codigo' => 'EX-07102023-18737',
                'no_soporte' => 'SOL-004',
                'descripcion' => 'Descripción de la solicitud 3',
                'cliente_id' => 1, // ID del cliente relacionado
                'direccion' => 'Dirección de la solicitud 3', // Agregamos la dirección
                'longitud' => "54321",
                'latitud' => "98765",
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'tipo_soporte_id' => 2, // ID del tipo de soporte
                'codigo' => 'EX-07102023-18738',
                'no_soporte' => 'SOL-005',
                'descripcion' => 'Descripción de la solicitud 3',
                'cliente_id' => 1, // ID del cliente relacionado
                'direccion' => 'Dirección de la solicitud 3', // Agregamos la dirección
                'longitud' => "54321",
                'latitud' => "98765",
                'estado' => 1,
                'created_at' => now(),
            ],
            [
                'tipo_soporte_id' => 2, // ID del tipo de soporte
                'codigo' => 'EX-07102023-18739',
                'no_soporte' => 'SOL-006',
                'descripcion' => 'Descripción de la solicitud 3',
                'cliente_id' => 1, // ID del cliente relacionado
                'direccion' => 'Dirección de la solicitud 3', // Agregamos la dirección
                'longitud' => "54321",
                'latitud' => "98765",
                'estado' => 1,
                'created_at' => now(),
            ],
        ];

        // Insertar los registros en la tabla solicitudes
        DB::table('solicitudes')->insert($solicitudes);
    }
}
