<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_recipiente_muestra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_recipiente_id');
            $table->unsignedBigInteger('tipo_muestra_id');
            $table->timestamps();

            $table->foreign('tipo_recipiente_id')->references('id')->on('tipo_recipientes');
            $table->foreign('tipo_muestra_id')->references('id')->on('tipo_muestras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_recipiente_muestra');
    }
};
