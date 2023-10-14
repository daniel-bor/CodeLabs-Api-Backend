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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->unique();
            $table->string('nit', 12)->notNull()->unique();
            $table->string('tax_name', 100)->nullable();
            $table->string('profesion', 50)->notNull();
            $table->string('no_expediente', 22)->notNull();
            $table->timestamps();

            // Definición de clave foránea
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
