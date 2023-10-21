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
        Schema::create('items_muestras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_item')->notNull();
            $table->unsignedBigInteger('id_muestra')->notNull();
            $table->integer('estado')->default(1);
            $table->timestamps();
            $table->softDeletes();

            // Definición de claves foráneas
            $table->foreign('id_item')->references('id')->on('items');
            $table->foreign('id_muestra')->references('id')->on('muestras');
        });
    }

    public function down()
    {
        Schema::dropIfExists('items_muestras');
    }
};
