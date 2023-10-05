<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetalleBitacoraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de detalle_bitacora
        $detalleBitacora = [
            [
                'encabezado_id' => 1, // ID del encabezado de bitácora relacionado
                'nombre_campo' => 'campo1',
                'valor_anterior' => 'valor_anterior_1',
                'valor_nuevo' => 'valor_nuevo_1',
            ],
            [
                'encabezado_id' => 2, // ID del encabezado de bitácora relacionado
                'nombre_campo' => 'campo2',
                'valor_anterior' => 'valor_anterior_2',
                'valor_nuevo' => 'valor_nuevo_2',
            ],
            // Agregar más registros de detalle_bitacora aquí
        ];

        // Insertar los registros en la tabla detalle_bitacora
        DB::table('detalle_bitacora')->insert($detalleBitacora);
    }
}
