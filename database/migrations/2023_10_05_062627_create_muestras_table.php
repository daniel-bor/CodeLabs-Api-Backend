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
            $table->string('codigo', 18)->notNull()->unique();
            $table->unsignedBigInteger('tipo_muestra_id')->notNull();
            $table->unsignedBigInteger('tipo_recipiente_id')->notNull();
            $table->integer('cantidad_unidades')->notNull();
            $table->unsignedBigInteger('unidad_medida_id')->notNull();
            $table->unsignedBigInteger('solicitud_id')->notNull();
            $table->timestamp('fecha_vencimiento')->notNull();
            $table->unsignedBigInteger('estado')->default(13);
            $table->timestamps();
            $table->softDeletes();

            // Definición de claves foráneas
            $table->foreign('tipo_muestra_id')->references('id')->on('tipo_muestras');
            $table->foreign('tipo_recipiente_id')->references('id')->on('tipo_recipientes');
            $table->foreign('unidad_medida_id')->references('id')->on('unidad_medidas');
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
            $table->foreign('estado')->references('id')->on('estado_solicitudes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('muestras');
    }
};
