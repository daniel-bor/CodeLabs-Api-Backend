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
        Schema::create('usuario_asignaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_asignado_id')->notNull();
            $table->unsignedBigInteger('usuario_asignador_id')->notNull();
            $table->unsignedBigInteger('solicitud_id')->notNull();
            $table->timestamp('fecha_creacion')->default(now());

            // Definición de claves foráneas
            $table->foreign('usuario_asignado_id')->references('id')->on('users');
            $table->foreign('usuario_asignador_id')->references('id')->on('users');
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_asignaciones');
    }
};
