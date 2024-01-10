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
        Schema::create('trazabilidad_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_id')->notNull();
            $table->unsignedBigInteger('estado_solicitud_id')->notNull();
            $table->string('observaciones', 100)->notNull();
            $table->unsignedBigInteger('usuario_asignador_id')->nullable();
            $table->unsignedBigInteger('usuario_asignado_id')->nullable();
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
            $table->foreign('estado_solicitud_id')->references('id')->on('estado_solicitudes');
            $table->foreign('usuario_asignador_id')->references('id')->on('users');
            $table->foreign('usuario_asignado_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('trazabilidad_solicitudes');
    }
};
