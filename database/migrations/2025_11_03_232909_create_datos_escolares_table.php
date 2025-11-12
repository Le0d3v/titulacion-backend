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
        Schema::create('datos_escolares', function (Blueprint $table) {
            $table->id();
            $table->string("carrera");
            $table->string("especialidad");
            $table->integer("cuatrimestre");
            $table->string(column: "turno");
            $table->string(column: "grupo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_escolares');
    }
};
