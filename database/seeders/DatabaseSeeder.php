<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TipoRecipiente;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Seeders para tablas fuertes
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(EmpleadosTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(TipoSoportesTableSeeder::class);
        $this->call(TipoExamenesTableSeeder::class);
        $this->call(UnidadMedidasTableSeeder::class);
        $this->call(EstadoSolicitudesTableSeeder::class);
        $this->call(SolicitudesTableSeeder::class);

        // Seeders para tablas intermedias o relacionadas
        $this->call(ItemsTableSeeder::class);
        $this->call(TipoMuestraTableSeeder::class);
        $this->call(TipoRecipienteTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(TipoDocumentoAnalisisTableSeeder::class);
        $this->call(MuestrasTableSeeder::class);
        $this->call(ItemsMuestrasTableSeeder::class);
        $this->call(DocumentosTableSeeder::class);
        $this->call(UsuarioAsignacionesTableSeeder::class);
        $this->call(ItemsSolicitudAnalisisTableSeeder::class);
        $this->call(TrazabilidadSolicitudesTableSeeder::class);
        $this->call(DocumentosAnalisisTableSeeder::class);

        // Otras tablas y seeders si las hay
        $this->call(EncabezadoBitacoraTableSeeder::class);
        $this->call(DetalleBitacoraTableSeeder::class);
        $this->call(TipoRecipienteMuestraTableSeeder::class);
    }
}
