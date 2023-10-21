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
        Schema::create('tipo_examenes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->notNull();
            $table->string('descripcion', 255)->notNull();
            $table->unsignedBigInteger('tipo_muestra_id')->notNull();
            $table->timestamp('fecha_creacion')->default(now());
            $table->timestamp('fecha_modificacion')->nullable();
            $table->unsignedBigInteger('creado_por')->notNull();
            $table->unsignedBigInteger('modificado_por')->nullable();
            $table->integer('estado')->default(1);

            /// Definición de claves foráneas
            $table->foreign('tipo_muestra_id')->references('id')->on('tipo_muestras');
            $table->foreign('creado_por')->references('id')->on('users');
            $table->foreign('modificado_por')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_examenes');
    }
};
