<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EncabezadoBitacoraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de encabezado_bitacora
        $encabezadosBitacora = [
            [
                'ip_maquina' => '192.168.1.1',
                'registro_id' => 1,
                'nombre_tabla' => 'tabla1',
                'tipo_de_operacion' => 'operacion1',
                'usuario_id' => 1, // ID del usuario relacionado
            ],
            [
                'ip_maquina' => '192.168.1.2',
                'registro_id' => 2,
                'nombre_tabla' => 'tabla2',
                'tipo_de_operacion' => 'operacion2',
                'usuario_id' => 2, // ID del usuario relacionado
            ],
            // Agregar más registros de encabezado_bitacora aquí
        ];

        // Insertar los registros en la tabla encabezado_bitacora
        DB::table('encabezado_bitacora')->insert($encabezadosBitacora);
    }
}
