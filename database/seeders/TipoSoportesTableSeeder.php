<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoSoportesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de tipo de soporte
        $tipoSoportes = [
            [
                'nombre' => 'No. Comprobante de pago', 'descripcion' => 'Numero de comprobante de pago.',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'No. Seguro Medico', 'descripcion' => 'Numero de afiliacion al seguro medico',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            // Agregar más tipos de soporte aquí
        ];

        // Insertar los registros en la tabla tipo_soportes
        DB::table('tipo_soportes')->insert($tipoSoportes);
    }
}
