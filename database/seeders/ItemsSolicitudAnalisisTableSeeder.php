<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemsSolicitudAnalisisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de items_solicitud_analisis
        $itemsSolicitudAnalisis = [
            [
                'solicitud_id' => 1, // ID de la solicitud relacionada
                'item_id' => 1, // ID del item relacionado
                'estado' => true,
            ],
            [
                'solicitud_id' => 2, // ID de la solicitud relacionada
                'item_id' => 2, // ID del item relacionado
                'estado' => true,
            ],
            // Agregar más registros de items_solicitud_analisis aquí
        ];

        // Insertar los registros en la tabla items_solicitud_analisis
        DB::table('items_solicitud_analisis')->insert($itemsSolicitudAnalisis);
    }
}
