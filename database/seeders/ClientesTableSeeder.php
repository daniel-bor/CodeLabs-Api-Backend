<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definir los 10 registros de clientes
        $clientes = [
            ['usuario_id' => 7, 'nit' => '123456789', 'tax_name' => 'LUIS_ALBERTO', 'profesion' => 'Ingeniero', 'no_expediente' => '7590-22-14705'],
            ['usuario_id' => 8, 'nit' => '987654321', 'tax_name' => 'JOSE_RODRIGUEZ', 'profesion' => 'Ingeniero', 'no_expediente' => '7590-22-31335'],
            ['usuario_id' => 9, 'nit' => '871632876', 'tax_name' => 'VICTOR_MENDOZA', 'profesion' => 'Ingeniero', 'no_expediente' => '7590-22-12312']
        ];
        // Insertar los registros en la tabla clientes
        DB::table('clientes')->insert($clientes);
    }
}
