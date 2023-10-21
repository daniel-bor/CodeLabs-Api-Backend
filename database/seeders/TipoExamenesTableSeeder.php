<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoExamenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los registros de tipos de exámenes
        $tipoExamenes = [
            [
                'nombre' => 'EXAMEN DE ORINA',
                'descripcion' => 'Análisis de orina para diagnóstico médico',
                'tipo_muestra_id' => 2,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'PERFIL LIPÍDICO',
                'descripcion' => 'Medición de lípidos en sangre para diagnóstico médico',
                'tipo_muestra_id' => 1,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'HEMOGRAMA COMPLETO',
                'descripcion' => 'Análisis completo de sangre para diagnóstico médico',
                'tipo_muestra_id' => 1,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'PRUEBA DE GLUCOSA',
                'descripcion' => 'Medición de glucosa en sangre para diagnóstico médico',
                'tipo_muestra_id' => 1,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'PANEL HEPÁTICO',
                'descripcion' => 'Análisis de función hepática para diagnóstico médico',
                'tipo_muestra_id' => 1,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'EVALUACIÓN TIROIDAL',
                'descripcion' => 'Análisis de función tiroidea para diagnóstico médico',
                'tipo_muestra_id' => 1,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'PERFIL DE VITAMINAS',
                'descripcion' => 'Medición de vitaminas en sangre para diagnóstico médico',
                'tipo_muestra_id' => 1,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'PANEL RENAL',
                'descripcion' => 'Análisis de función renal para diagnóstico médico',
                'tipo_muestra_id' => 1,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'PRUEBA DE ENFERMEDADES INFECCIOSAS SANGRE',
                'descripcion' => 'Detección de enfermedades infecciosas para diagnóstico médico',
                'tipo_muestra_id' => 1,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'EVALUACIÓN DE HORMONAS',
                'descripcion' => 'Análisis de hormonas para diagnóstico médico',
                'tipo_muestra_id' => 1,
                'creado_por' => 1,
                'estado' => 1,
            ],
            //Analisis con muestra tejido
            [
                'nombre' => 'Biopsia de Tejido',
                'descripcion' => 'Análisis de tejido para diagnóstico médico',
                'tipo_muestra_id' => 3,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Citología de Tejido',
                'descripcion' => 'Análisis de hormonas para diagnóstico médico',
                'tipo_muestra_id' => 3,
                'creado_por' => 1,
                'estado' => 1,
            ],
            //Analisis con muestra heces
            [
                'nombre' => 'Análisis de Heces para Sangre Oculta',
                'descripcion' => 'Análisis de hormonas para diagnóstico médico',
                'tipo_muestra_id' => 4,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Coproscopía',
                'descripcion' => 'Análisis de hormonas para diagnóstico médico',
                'tipo_muestra_id' => 4,
                'creado_por' => 1,
                'estado' => 1,
            ],
            //Analisis con muestra secreciones
            [
                'nombre' => 'Cultivo de Secreciones Respiratorias',
                'descripcion' => 'Análisis de hormonas para diagnóstico médico',
                'tipo_muestra_id' => 5,
                'creado_por' => 1,
                'estado' => 1,
            ],
            [
                'nombre' => 'Análisis de Secreciones Oculares',
                'descripcion' => 'Análisis de hormonas para diagnóstico médico',
                'tipo_muestra_id' => 5,
                'creado_por' => 1,
                'estado' => 1,
            ],
        ];

        // Insertar los registros en la tabla tipo_examenes
        DB::table('tipo_examenes')->insert($tipoExamenes);
    }
}
