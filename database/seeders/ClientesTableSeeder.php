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
            ['usuario_id' => 1, 'nit' => '123456789', 'profesion' => 'Ingeniero', 'NoExpediente' => '7590-22-14705'],
            ['usuario_id' => 2, 'nit' => '987654321', 'profesion' => 'Ingeniero', 'NoExpediente' => '7590-22-31335'],
            ['usuario_id' => 3, 'nit' => '871632876', 'profesion' => 'Ingeniero', 'NoExpediente' => '7590-22-12312']
            // Agregar otros clientes aquí
        ];
        // Insertar los registros en la tabla clientes
        DB::table('clientes')->insert($clientes);
    }
}
