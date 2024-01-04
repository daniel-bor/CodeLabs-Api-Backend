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
        Schema::create('estado_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->notNull();
            $table->string('descripcion', 100)->notNull();
            $table->timestamp('fecha_creacion')->default(now());
            $table->timestamp('fecha_modificacion')->nullable();
            $table->unsignedBigInteger('estado_anterior')->nullable();
            $table->unsignedBigInteger('estado_siguiente')->nullable();
            $table->unsignedBigInteger('empleado_rol')->nullable();
            $table->unsignedBigInteger('creado_por')->notNull();
            $table->unsignedBigInteger('modificado_por')->nullable();
            $table->integer('estado')->default(1);

            // Definición de claves foráneas
            $table->foreign('estado_anterior')->references('id')->on('estado_solicitudes');
            $table->foreign('estado_siguiente')->references('id')->on('estado_solicitudes');
            $table->foreign('empleado_rol')->references('id')->on('roles');
            $table->foreign('creado_por')->references('id')->on('users');
            $table->foreign('modificado_por')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estado_solicitudes');
    }
};
