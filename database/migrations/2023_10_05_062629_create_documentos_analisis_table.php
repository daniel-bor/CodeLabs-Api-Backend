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
            $table->unsignedBigInteger('item_muestra_id')->notNull();
            $table->unsignedBigInteger('tipo_documento_analisis_id')->default(1);
            $table->string('conclusion', 100)->notNull();
            $table->integer('estado')->default(1);
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('item_muestra_id')->references('id')->on('items_muestras');
            $table->foreign('tipo_documento_analisis_id')->references('id')->on('tipo_documento_analisis');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos_analisis');
    }
};
