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
            $table->boolean("validacion_memoria_estadia");
            $table->boolean("validacion_datos_personales");
            $table->boolean("encuesta_egresados");
            $table->boolean("carga_imagen");
            $table->boolean("pago_donacion");
            $table->boolean("pago_titulo");
            $table->boolean("completado")->default(0);
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
