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
        Schema::create('documentos_analisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('muestra_id')->notNull();
            $table->unsignedBigInteger('tipo_documento_analisis_id')->notNull();
            $table->string('conclusion', 100)->notNull();
            $table->timestamp('fecha_creacion')->default(now());
            $table->boolean('estado')->default(true);

            // Definición de claves foráneas
            $table->foreign('muestra_id')->references('id')->on('muestras');
            $table->foreign('tipo_documento_analisis_id')->references('id')->on('tipo_documento_analisis');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos_analisis');
    }
};
