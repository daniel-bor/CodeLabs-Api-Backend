<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_soporte_id')->notNull();
            $table->string('codigo', 20)->notNull();
            $table->string('no_soporte', 50)->notNull();
            $table->string('descripcion', 100)->notNull();
            $table->unsignedBigInteger('cliente_id')->notNull();
            $table->string('direccion', 100)->notNull();
            $table->string('longitud')->notNull();
            $table->string('latitud')->notNull();
            $table->unsignedBigInteger('estado')->default(1);
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Definición de claves foráneas
            $table->foreign('tipo_soporte_id')->references('id')->on('tipo_soportes');
            $table->foreign('cliente_id')->references('usuario_id')->on('clientes');
            $table->foreign('estado')->references('id')->on('estado_solicitudes');
            $table->foreign('empleado_id')->references('usuario_id')->on('empleados');
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
};
