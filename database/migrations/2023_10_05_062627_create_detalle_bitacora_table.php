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
        Schema::create('detalle_bitacora', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('encabezado_id')->notNull();
            $table->string('nombre_campo', 50)->notNull();
            $table->string('valor_anterior', 50)->notNull();
            $table->string('valor_nuevo', 50)->notNull();

            // Definición de clave foránea
            $table->foreign('encabezado_id')->references('id')->on('encabezado_bitacora');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalle_bitacora');
    }
};
