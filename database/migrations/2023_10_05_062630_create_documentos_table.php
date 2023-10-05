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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitud_id')->notNull();
            $table->string('observaciones', 100)->notNull();
            $table->string('ruta', 100)->notNull();
            $table->timestamp('fecha_creacion')->default(now());
            $table->boolean('estado')->default(true);

            // Definición de claves foráneas
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
};
