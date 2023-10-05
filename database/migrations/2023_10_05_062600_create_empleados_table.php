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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->unique();
            $table->unsignedBigInteger('rol_id')->notNull();
            $table->timestamp('fecha_creacion')->default(now());

            // Definición de claves foráneas
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('rol_id')->references('id')->on('roles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
