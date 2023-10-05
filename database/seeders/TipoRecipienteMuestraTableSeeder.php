<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoRecipienteMuestraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de tipos de recipiente de muestra
        $tiposRecipienteMuestra = [
            [
                'nombre' => 'Frasco',
                'descripcion' => 'Recipiente tipo frasco',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            [
                'nombre' => 'Tubo de ensayo',
                'descripcion' => 'Recipiente tipo tubo de ensayo',
                'creado_por' => 1, // ID del usuario que creó este estado
                'estado' => 1, // Puedes usar 1 para activo o 0 para inactivo
            ],
            // Agregar más tipos de recipiente de muestra aquí
        ];

        // Insertar los registros en la tabla tipo_recipiente_muestra
        DB::table('tipo_recipiente_muestra')->insert($tiposRecipienteMuestra);
    }
}
