<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $examenOrinaItems = [
            [
                'nombre' => 'Análisis de pH de la orina',
                'descripcion' => 'Medición del pH en la muestra de orina',
                'tipo_examen_id' => 1, // ID del tipo de examen relacionado
                'creado_por' => 1, // ID del usuario que creó el registro
                'created_at' => now()
            ],
            [
                'nombre' => 'Detección de proteínas en la orina',
                'descripcion' => 'Identificación de la presencia de proteínas en la orina',
                'tipo_examen_id' => 1,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Identificación de glucosa en la orina',
                'descripcion' => 'Medición de los niveles de glucosa en la orina',
                'tipo_examen_id' => 1,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Análisis de cetonas en la orina',
                'descripcion' => 'Detección de cetonas en la muestra de orina',
                'tipo_examen_id' => 1,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Detección de bilirrubina y urobilinógeno',
                'descripcion' => 'Identificación de bilirrubina y urobilinógeno en la orina',
                'tipo_examen_id' => 1,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Prueba de densidad urinaria',
                'descripcion' => 'Medición de la densidad de la orina',
                'tipo_examen_id' => 1,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Evaluación de sedimentos urinarios',
                'descripcion' => 'Examen microscópico de los sedimentos en la orina',
                'tipo_examen_id' => 1,
                'creado_por' => 1,
                'created_at' => now()
            ],
        ];

        $perfilLipidicoItems = [
            [
                'nombre' => 'Medición del colesterol total',
                'descripcion' => 'Medición de la cantidad total de colesterol en la sangre',
                'tipo_examen_id' => 2, // ID del tipo de examen relacionado
                'creado_por' => 1, // ID del usuario que creó el registro
                'created_at' => now()
            ],
            [
                'nombre' => 'Niveles de lipoproteínas de alta densidad (HDL)',
                'descripcion' => 'Medición de los niveles de lipoproteínas de alta densidad en la sangre',
                'tipo_examen_id' => 2,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Niveles de lipoproteínas de baja densidad (LDL)',
                'descripcion' => 'Medición de los niveles de lipoproteínas de baja densidad en la sangre',
                'tipo_examen_id' => 2,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Triglicéridos en sangre',
                'descripcion' => 'Medición de los niveles de triglicéridos en la sangre',
                'tipo_examen_id' => 2,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Relación colesterol total/HDL',
                'descripcion' => 'Cálculo de la relación entre el colesterol total y las lipoproteínas de alta densidad',
                'tipo_examen_id' => 2,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Relación LDL/HDL',
                'descripcion' => 'Cálculo de la relación entre las lipoproteínas de baja densidad y las lipoproteínas de alta densidad',
                'tipo_examen_id' => 2,
                'creado_por' => 1,
                'created_at' => now()
            ],
        ];

        $hemogramaCompletoItems = [
            [
                'nombre' => 'Recuento de glóbulos rojos',
                'descripcion' => 'Conteo de la cantidad de glóbulos rojos en la sangre',
                'tipo_examen_id' => 3, // ID del tipo de examen relacionado
                'creado_por' => 1, // ID del usuario que creó el registro
                'created_at' => now()
            ],
            [
                'nombre' => 'Recuento de glóbulos blancos y subtipos',
                'descripcion' => 'Conteo de la cantidad de glóbulos blancos y clasificación por subtipos',
                'tipo_examen_id' => 3,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Hemoglobina y hematocrito',
                'descripcion' => 'Medición de los niveles de hemoglobina y el hematocrito en la sangre',
                'tipo_examen_id' => 3,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Plaquetas en sangre',
                'descripcion' => 'Conteo de la cantidad de plaquetas en la sangre',
                'tipo_examen_id' => 3,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Fórmula leucocitaria',
                'descripcion' => 'Análisis de la composición de los glóbulos blancos en la sangre',
                'tipo_examen_id' => 3,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Análisis de glóbulos rojos: VCM, HCM, CHCM',
                'descripcion' => 'Medición de los valores medios de los glóbulos rojos',
                'tipo_examen_id' => 3,
                'creado_por' => 1,
                'created_at' => now()
            ],
        ];

        $pruebaGlucosaItems = [
            [
                'nombre' => 'Niveles de glucosa en ayunas',
                'descripcion' => 'Medición de los niveles de glucosa en sangre después de un período de ayuno',
                'tipo_examen_id' => 4, // ID del tipo de examen relacionado
                'creado_por' => 1, // ID del usuario que creó el registro
                'created_at' => now()
            ],
            [
                'nombre' => 'Prueba de tolerancia a la glucosa oral',
                'descripcion' => 'Evaluación de la respuesta de glucosa en sangre después de la ingestión de glucosa',
                'tipo_examen_id' => 4,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Prueba de glucosa aleatoria',
                'descripcion' => 'Medición de los niveles de glucosa en sangre en cualquier momento del día',
                'tipo_examen_id' => 4,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Monitoreo de glucosa posprandial (después de comer)',
                'descripcion' => 'Medición de los niveles de glucosa en sangre después de una comida',
                'tipo_examen_id' => 4,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Hemoglobina A1c (HbA1c), control glucémico a largo plazo',
                'descripcion' => 'Medición de los niveles de HbA1c para evaluar el control glucémico a largo plazo',
                'tipo_examen_id' => 4,
                'creado_por' => 1,
                'created_at' => now()
            ],
        ];

        $panelHepaticoItems = [
            [
                'nombre' => 'Alanina aminotransferasa (ALT)',
                'descripcion' => 'Medición de la enzima ALT en la sangre, indicador de la salud del hígado',
                'tipo_examen_id' => 5, // ID del tipo de examen relacionado
                'creado_por' => 1, // ID del usuario que creó el registro
                'created_at' => now()
            ],
            [
                'nombre' => 'Aspartato aminotransferasa (AST)',
                'descripcion' => 'Medición de la enzima AST en la sangre, también relacionada con la salud hepática',
                'tipo_examen_id' => 5,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Bilirrubina total y directa',
                'descripcion' => 'Medición de los niveles de bilirrubina en la sangre, incluyendo la bilirrubina directa',
                'tipo_examen_id' => 5,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Fosfatasa alcalina (ALP)',
                'descripcion' => 'Medición de la enzima fosfatasa alcalina en la sangre',
                'tipo_examen_id' => 5,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Proteínas totales y albúmina',
                'descripcion' => 'Medición de las proteínas totales y la albúmina en la sangre',
                'tipo_examen_id' => 5,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Relación albúmina/globulina (A/G)',
                'descripcion' => 'Cálculo de la relación entre la albúmina y las globulinas en la sangre',
                'tipo_examen_id' => 5,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Gamma-glutamiltransferasa (GGT)',
                'descripcion' => 'Medición de la enzima GGT en la sangre, otro indicador de la salud hepática',
                'tipo_examen_id' => 5,
                'creado_por' => 1,
                'created_at' => now()
            ],
        ];

        $evaluacionTiroidalItems = [
            [
                'nombre' => 'Hormona estimulante de la tiroides (TSH)',
                'descripcion' => 'Medición de la hormona estimulante de la tiroides (TSH) en la sangre',
                'tipo_examen_id' => 6, // ID del tipo de examen relacionado
                'creado_por' => 1, // ID del usuario que creó el registro
                'created_at' => now()
            ],
            [
                'nombre' => 'T4 libre (Tiroxina libre)',
                'descripcion' => 'Medición de los niveles de tiroxina libre (T4 libre) en la sangre',
                'tipo_examen_id' => 6,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'T3 total (Triyodotironina total)',
                'descripcion' => 'Medición de los niveles de triyodotironina total (T3 total) en la sangre',
                'tipo_examen_id' => 6,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'T3 inversa (RT3)',
                'descripcion' => 'Medición de los niveles de triyodotironina inversa (RT3) en la sangre',
                'tipo_examen_id' => 6,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Anticuerpos antitiroideos (TPO y Tg)',
                'descripcion' => 'Detección de anticuerpos antitiroideos, incluyendo TPO y Tg',
                'tipo_examen_id' => 6,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Calcitonina (en algunos casos)',
                'descripcion' => 'Medición de los niveles de calcitonina en la sangre (en algunos casos)',
                'tipo_examen_id' => 6,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Tiroglobulina (en seguimiento de cáncer de tiroides)',
                'descripcion' => 'Medición de los niveles de tiroglobulina en el seguimiento de cáncer de tiroides',
                'tipo_examen_id' => 6,
                'creado_por' => 1,
                'created_at' => now()
            ],
        ];

        $perfilVitaminasItems = [
            [
                'nombre' => 'Vitamina D (calcidiol)',
                'descripcion' => 'Medición de los niveles de vitamina D (calcidiol) en la sangre',
                'tipo_examen_id' => 7, // ID del tipo de examen relacionado
                'creado_por' => 1, // ID del usuario que creó el registro
                'created_at' => now()
            ],
            [
                'nombre' => 'Vitamina B12 (cobalamina)',
                'descripcion' => 'Medición de los niveles de vitamina B12 (cobalamina) en la sangre',
                'tipo_examen_id' => 7,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Folato (ácido fólico)',
                'descripcion' => 'Medición de los niveles de folato (ácido fólico) en la sangre',
                'tipo_examen_id' => 7,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Vitamina A',
                'descripcion' => 'Medición de los niveles de vitamina A en la sangre',
                'tipo_examen_id' => 7,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Vitamina E',
                'descripcion' => 'Medición de los niveles de vitamina E en la sangre',
                'tipo_examen_id' => 7,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Vitamina K',
                'descripcion' => 'Medición de los niveles de vitamina K en la sangre',
                'tipo_examen_id' => 7,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Vitamina C',
                'descripcion' => 'Medición de los niveles de vitamina C en la sangre',
                'tipo_examen_id' => 7,
                'creado_por' => 1,
                'created_at' => now()
            ],
        ];

        $panelRenalItems = [
            [
                'nombre' => 'Creatinina',
                'descripcion' => 'Medición de los niveles de creatinina en la sangre, indicador de la función renal',
                'tipo_examen_id' => 8, // ID del tipo de examen relacionado
                'creado_por' => 1, // ID del usuario que creó el registro
                'created_at' => now()
            ],
            [
                'nombre' => 'Nitrógeno ureico en sangre (BUN)',
                'descripcion' => 'Medición de los niveles de nitrógeno ureico en la sangre, otro indicador de la función renal',
                'tipo_examen_id' => 8,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Filtrado glomerular estimado (eGFR)',
                'descripcion' => 'Cálculo del índice de filtrado glomerular estimado, importante para evaluar la función renal',
                'tipo_examen_id' => 8,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Electrolitos (sodio, potasio, cloruro)',
                'descripcion' => 'Medición de los niveles de electrolitos en la sangre, incluyendo sodio, potasio y cloruro',
                'tipo_examen_id' => 8,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Ácido úrico',
                'descripcion' => 'Medición de los niveles de ácido úrico en la sangre',
                'tipo_examen_id' => 8,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Fosfato en sangre',
                'descripcion' => 'Medición de los niveles de fosfato en la sangre',
                'tipo_examen_id' => 8,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Relación BUN/creatinina',
                'descripcion' => 'Cálculo de la relación entre el nitrógeno ureico en sangre (BUN) y la creatinina',
                'tipo_examen_id' => 8,
                'creado_por' => 1,
                'created_at' => now()
            ],
        ];

        $pruebaEnfermedadesInfecciosasItems = [
            [
                'nombre' => 'Detección de enfermedades de transmisión sexual (ETS)',
                'descripcion' => 'Pruebas para detectar enfermedades de transmisión sexual, como la sífilis y la gonorrea',
                'tipo_examen_id' => 9, // ID del tipo de examen relacionado
                'creado_por' => 1, // ID del usuario que creó el registro
                'created_at' => now()
            ],
            [
                'nombre' => 'Pruebas de detección de VIH',
                'descripcion' => 'Pruebas para detectar el virus de la inmunodeficiencia humana (VIH)',
                'tipo_examen_id' => 9,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Pruebas de hepatitis (HBV y HCV)',
                'descripcion' => 'Pruebas para detectar las infecciones por virus de la hepatitis B (HBV) y hepatitis C (HCV)',
                'tipo_examen_id' => 9,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Pruebas de sífilis',
                'descripcion' => 'Pruebas para detectar la infección por sífilis',
                'tipo_examen_id' => 9,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Detección de enfermedades bacterianas y virales',
                'descripcion' => 'Pruebas para detectar diversas enfermedades infecciosas causadas por bacterias y virus',
                'tipo_examen_id' => 9,
                'creado_por' => 1,
                'created_at' => now()
            ],
        ];

        $evaluacionHormonasItems = [
            [
                'nombre' => 'Hormona estimulante de la tiroides (TSH)',
                'descripcion' => 'Medición de la hormona estimulante de la tiroides (TSH) en la sangre',
                'tipo_examen_id' => 10, // ID del tipo de examen relacionado
                'creado_por' => 1, // ID del usuario que creó el registro
                'created_at' => now()
            ],
            [
                'nombre' => 'Hormonas tiroideas (T4 y T3)',
                'descripcion' => 'Medición de los niveles de tiroxina (T4) y triyodotironina (T3) en la sangre',
                'tipo_examen_id' => 10,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Hormonas sexuales (estradiol, progesterona, testosterona)',
                'descripcion' => 'Medición de las hormonas sexuales como estradiol, progesterona y testosterona en la sangre',
                'tipo_examen_id' => 10,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Hormona luteinizante (LH) y hormona foliculoestimulante (FSH)',
                'descripcion' => 'Medición de las hormonas LH y FSH en la sangre, relacionadas con la función reproductiva',
                'tipo_examen_id' => 10,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Hormona del crecimiento (GH)',
                'descripcion' => 'Medición de la hormona del crecimiento (GH) en la sangre',
                'tipo_examen_id' => 10,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Hormona adrenocorticótropa (ACTH)',
                'descripcion' => 'Medición de la hormona adrenocorticótropa (ACTH) en la sangre',
                'tipo_examen_id' => 10,
                'creado_por' => 1,
                'created_at' => now()
            ],
            [
                'nombre' => 'Hormona antidiurética (ADH) y oxitocina',
                'descripcion' => 'Medición de las hormonas antidiurética (ADH) y oxitocina en la sangre',
                'tipo_examen_id' => 10,
                'creado_por' => 1,
                'created_at' => now()
            ],
        ];



        // Insertar los registros en la tabla items
        DB::table('items')->insert($examenOrinaItems);
        DB::table('items')->insert($perfilLipidicoItems);
        DB::table('items')->insert($hemogramaCompletoItems);
        DB::table('items')->insert($pruebaGlucosaItems);
        DB::table('items')->insert($panelHepaticoItems);
        DB::table('items')->insert($evaluacionTiroidalItems);
        DB::table('items')->insert($perfilVitaminasItems);
        DB::table('items')->insert($panelRenalItems);
        DB::table('items')->insert($pruebaEnfermedadesInfecciosasItems);
        DB::table('items')->insert($evaluacionHormonasItems);
    }
}
