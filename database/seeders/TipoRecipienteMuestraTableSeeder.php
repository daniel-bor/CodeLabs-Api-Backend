<?php

namespace Database\Seeders;

use App\Models\TipoMuestra;
use App\Models\TipoRecipiente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoRecipienteMuestraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtén tipos de recipientes y tipos de muestra
        $tiposRecipiente = TipoRecipiente::all();
        $tiposMuestra = TipoMuestra::all();

        // Asocia tipos de recipientes con tipos de muestra
        foreach ($tiposRecipiente as $tipoRecipiente) {
            $tipoMuestraIds = $tiposMuestra->pluck('id')->random(3); // Asocia 3 tipos de muestra aleatorios
            $tipoRecipiente->tiposMuestra()->attach($tipoMuestraIds);
        }
    }
}
