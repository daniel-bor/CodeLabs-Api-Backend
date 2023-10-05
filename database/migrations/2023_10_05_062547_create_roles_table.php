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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->notNull();
            $table->string('descripcion', 100)->notNull();
            $table->timestamp('fecha_creacion')->default(now());
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
