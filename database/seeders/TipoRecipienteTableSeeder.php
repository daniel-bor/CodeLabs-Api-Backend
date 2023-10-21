<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoRecipienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de tipos de recipiente de muestra
        $tiposRecipientes = [
            [
                'nombre' => 'Tubo de extracción de sangre',
                'descripcion' => 'Tubo de extracción de sangre',
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Tubo al vacío',
                'descripcion' => 'Tubo al vacío',
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Tubo con anticoagulantes',
                'descripcion' => 'Tubo con anticoagulantes',
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Tubo de recoleccion estéril',
                'descripcion' => 'Tubo de recoleccion estéril',
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Tubo de ensayo con tapa rosca',
                'descripcion' => 'Tubo de ensayo con tapa rosca',
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Tubo de ensayo con tapa hermetica',
                'descripcion' => 'Tubo de ensayo con tapa hermetica',
                'creado_por' => 1,
                'estado' => 1,
            ],

            [
                'nombre' => 'Frasco estéril hermetico',
                'descripcion' => 'Frasco estéril hermetico',
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Frasco de formol',
                'descripcion' => 'Frasco de formol',
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Frasco con solucion de conservación',
                'descripcion' => 'Frasco con solucion de conservación',
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Tubo con líquido de transporte',
                'descripcion' => 'Tubo con líquido de transporte',
                'creado_por' => 1,
                'estado' => 1,
            ],

            [
                'nombre' => 'Envase de transporte',
                'descripcion' => 'Envase de transporte',
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Envase estéril con tapa hermética',
                'descripcion' => 'Envase estéril con tapa hermética',
                'creado_por' => 1,
                'estado' => 1,
            ],
            // Agregar más tipos de recipiente de muestra aquí
        ];

        // Insertar los registros en la tabla
        DB::table('tipo_recipientes')->insert($tiposRecipientes);
    }
}
