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
        Schema::create('muestras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_muestra_id')->notNull();
            $table->unsignedBigInteger('tipo_recipiente_muestra_id')->notNull();
            $table->integer('cantidad_unidades')->notNull();
            $table->unsignedBigInteger('unidad_medida_id')->notNull();
            $table->string('etiqueta', 50)->notNull();
            $table->unsignedBigInteger('solicitud_id')->notNull();
            $table->timestamp('dia_vencimiento')->notNull();
            $table->boolean('estado')->default(true);
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('tipo_muestra_id')->references('id')->on('tipo_muestra');
            $table->foreign('tipo_recipiente_muestra_id')->references('id')->on('tipo_recipiente_muestra');
            $table->foreign('unidad_medida_id')->references('id')->on('unidad_medidas');
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('muestras');
    }
};
