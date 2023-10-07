<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_soporte_id')->notNull();
            $table->string('codigo_solicitud')->notNull();
            $table->string('no_soporte', 50)->notNull();
            $table->string('descripcion', 100)->notNull();
            $table->unsignedBigInteger('cliente_id')->notNull();
            $table->string('longitud')->notNull();
            $table->string('latitud')->notNull();
            $table->integer('estado')->default(1);
            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('tipo_soporte_id')->references('id')->on('tipo_soportes');
            $table->foreign('cliente_id')->references('usuario_id')->on('clientes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
};
