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
        $estados = [0, 1, 2, 3];
        
        for($i = 1; $i < 723; $i++) {
            $data = [];
            $data["validacion_memoria_estadia"] = array_rand($estados);
            $data["validacion_datos_personales"] = array_rand($estados);
            $data["encuesta_egresados"] = array_rand($estados);
            $data["carga_imagen"] = array_rand($estados);
            $data["pago_donacion"] = array_rand($estados);
            $data["pago_titulo"] = array_rand($estados);
            $data["completado"] = 0;
            $data["created_at"] = Carbon::now();
            $data["updated_at"] = Carbon::now();

            DB::table("procesos")->insert($data);
        }
    }
}
