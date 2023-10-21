<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoMuestraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de tipos de muestra
        $tiposMuestra = [
            [
                'nombre' => 'SANGRE',
                'descripcion' => 'Muestra de sangre',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'ORINA',
                'descripcion' => 'Muestra de orina',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'TEJIDOS CORPORALES',
                'descripcion' => 'Muestra de tejidos corporales',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'HECES',
                'descripcion' => 'Muestra de eses',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'FLUIDOS CORPORALES',
                'descripcion' => 'Muestra de fluidos corporales',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'ISOPOS',
                'descripcion' => 'Para pruebas de enfermedades infecciosas',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ]
        ];

        // Insertar los registros en la tabla tipo_muestra
        DB::table('tipo_muestras')->insert($tiposMuestra);
    }
}
