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
        Schema::create('tipo_documento_analisis', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->notNull();
            $table->string('descripcion', 100)->notNull();
            $table->timestamp('fecha_creacion')->default(now());
            $table->timestamp('fecha_modificacion')->nullable();
            $table->unsignedBigInteger('creado_por')->notNull();
            $table->unsignedBigInteger('modificado_por')->nullable();
            $table->integer('estado')->default(1);

            // Definición de claves foráneas
            $table->foreign('creado_por')->references('id')->on('users');
            $table->foreign('modificado_por')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_documento_analisis');
    }
};
