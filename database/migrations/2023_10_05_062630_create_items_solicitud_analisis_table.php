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
        Schema::create('items_solicitud_analisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_id')->notNull();
            $table->unsignedBigInteger('item_id')->notNull();
            $table->boolean('estado')->default(true);
            $table->timestamp('fecha_creacion')->default(now());

            // Definición de claves foráneas
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    public function down()
    {
        Schema::dropIfExists('items_solicitud_analisis');
    }
};
