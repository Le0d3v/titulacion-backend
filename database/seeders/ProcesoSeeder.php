<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProcesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        for($i = 1; $i < 5; $i++) {
            $data = [];
            $data["id"] = $i;
            $data["validacion_memoria_estadia"] = null;
            $data["validacion_datos_personales"] = null;
            $data["encuesta_egresados"] = null;
            $data["carga_imagen"] = null;
            $data["pago_donacion"] = null;
            $data["pago_titulo"] = null;
            $data["completado"] = null;
            $data["created_at"] = Carbon::now();
            $data["updated_at"] = Carbon::now();

            DB::table("procesos")->insert($data);
        }

        for($i = 5; $i < 729; $i++) {
            $data = [];
            $data["id"] = $i;
            $data["validacion_memoria_estadia"] = 0;
            $data["validacion_datos_personales"] = 0;
            $data["encuesta_egresados"] = 0;
            $data["carga_imagen"] = 0;
            $data["pago_donacion"] = 0;
            $data["pago_titulo"] = 0;
            $data["completado"] = 0;
            $data["created_at"] = Carbon::now();
            $data["updated_at"] = Carbon::now();

            DB::table("procesos")->insert($data);
        }
    }
}
