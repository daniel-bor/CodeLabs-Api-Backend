<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('encabezado_bitacora', function (Blueprint $table) {
            $table->id();
            $table->string('ip_maquina', 50)->notNull();
            $table->integer('registro_id')->notNull();
            $table->string('nombre_tabla', 50)->notNull();
            $table->string('tipo_de_operacion', 50)->notNull();
            $table->unsignedBigInteger('usuario_id')->notNull();
            $table->timestamp('fecha_creacion')->default(now());

            // Definición de claves foráneas u otras restricciones, si es necesario.
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('encabezado_bitacora');
    }
};
