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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->notNull();
            $table->string('descripcion', 255)->notNull();
            $table->unsignedBigInteger('tipo_examen_id')->notNull();
            $table->unsignedBigInteger('creado_por')->notNull();
            $table->unsignedBigInteger('modificado_por')->nullable();
            $table->integer('estado')->default(1);
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('creado_por')->references('id')->on('users');
            $table->foreign('modificado_por')->references('id')->on('users');
            $table->foreign('tipo_examen_id')->references('id')->on('tipo_examenes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
};
