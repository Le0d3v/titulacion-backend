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
            $table->string("carrera")->nullable();
            $table->string("especialidad")->nullable();
            $table->integer("cuatrimestre")->nullable();
            $table->string(column: "turno")->nullable();
            $table->string(column: "grupo")->nullable();
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
