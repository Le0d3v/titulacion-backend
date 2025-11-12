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
        Schema::table('users', function (Blueprint $table) {
            $table->string("apellido_paterno");
            $table->string("apellido_materno");
            $table->date("fecha_nacimiento");
            $table->string("matricula");
            $table->string("curp");
            $table->string("rfc");
            $table->string("telefono");
            $table->string("genero");
            $table->string("estado_civil");
            $table->string("telefono_emergencia_1");
            $table->string("telefono_emergencia_2");
            $table->foreignId("domicilio_id")->constrained()->onDelete("CASCADE");
            $table->foreignId("datos_escolares_id")->nullable()->constrained()->onDelete("CASCADE");
            $table->foreignId("proceso_id")->nullable()->constrained()->onDelete("CASCADE");
            $table->boolean("admin");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['domicilio_id']);
            $table->dropForeign(['datos_escolares_id']);
            $table->dropForeign(['proceso_id']);

            $table->dropColumn([
                'apellido_paterno',
                'apellido_materno',
                'fecha_nacimiento',
                'matricula',
                'curp',
                'rfc',
                'telefono',
                'genero',
                'estado_civil',
                'telefono_emergencia_1',
                'telefono_emergencia_2',
                'domicilio_id',
                'datos_escolares_id',
                'proceso_id',
                'admin',
            ]);
        });
    }
};
