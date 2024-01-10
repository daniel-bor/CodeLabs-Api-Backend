<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemsMuestrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de items_muestras
        $itemsMuestras = [
            [
                'id_item' => 1, // ID del item relacionado
                'id_muestra' => 1, // ID de la muestra relacionada
            ],
            [
                'id_item' => 2, // ID del item relacionado
                'id_muestra' => 1, // ID de la muestra relacionada
            ],
            // Agregar más registros de items_muestras aquí
        ];

        // Insertar los registros en la tabla items_muestras
        DB::table('items_muestras')->insert($itemsMuestras);
    }
}
