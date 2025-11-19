<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArchivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i < 729; $i++) {
            $data = [];
            $data["id"] = $i;
            $data["memoria_estadia"] = null;
            $data["imagen_titulacion"] = null;
            $data["comprobante_donacion"] = null;
            $data["referencia_pago"] = null;
            $data["created_at"] = Carbon::now();
            $data["updated_at"] = Carbon::now();

            DB::table("archivos")->insert($data);
        }
    }
}
