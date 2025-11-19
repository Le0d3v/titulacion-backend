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
        Schema::create('procesos', function (Blueprint $table) {
            $table->id();
            $table->boolean("validacion_memoria_estadia")->nullable();
            $table->boolean("validacion_datos_personales")->nullable();
            $table->boolean("encuesta_egresados")->nullable();
            $table->boolean("carga_imagen")->nullable();
            $table->boolean("pago_donacion")->nullable();
            $table->boolean("pago_titulo")->nullable();
            $table->boolean("completado")->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procesos');
    }
};
