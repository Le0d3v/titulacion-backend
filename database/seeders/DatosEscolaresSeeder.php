<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatosEscolaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carreras = [
            "Tecnologías de la Información",
            "Procesos Industriales",
            "Procesos Alimenticios",
            "Mecatrónica",
            "Administración",
            "Diseño Textil y Moda",
            "Metal Mecánica",
            "Mercadotecnia",
        ];

        $cuatrimestres = [6, 11];

        $especialidades = [
            "TI" => ["DSM", "EVND", "IRD"],
            "PIA" => "Automotriz",
            "PA" => ["TA", "PAG"],
            "MECA" => ["Automatización", "IE", "Robotica"],
            "ADMIN" => "EFEP",
            "DTM" => ["DMIP", "CP"],
            "MC" => ["MI", "MMT"],
            "M" => "Mecatrónica",
        ];

        $grupos = [
            "6" => ["6A", "6B", "6C"],
            "11" => ["11A", "11B", "11C"]
        ];

        for ($i = 1; $i < 723; $i++) {
            $data = [];

            $data["carrera"] = $carreras[array_rand($carreras)];

            switch ($data["carrera"]) {
                case "Tecnologías de la Información":
                    $data["especialidad"] = $especialidades["TI"][array_rand($especialidades["TI"])];
                    break;
                case "Procesos Industriales":
                    $data["especialidad"] = $especialidades["PIA"];
                    break;
                case "Procesos Alimenticios":
                    $data["especialidad"] = $especialidades["PA"][array_rand($especialidades["PA"])];
                    break;
                case "Mecatrónica":
                    $data["especialidad"] = $especialidades["MECA"][array_rand($especialidades["MECA"])];
                    break;
                case "Administración":
                    $data["especialidad"] = $especialidades["ADMIN"];
                    break;
                case "Diseño Textil y Moda":
                    $data["especialidad"] = $especialidades["DTM"][array_rand($especialidades["DTM"])];
                    break;
                case "Metal Mecánica":
                    $data["especialidad"] = $especialidades["MC"][array_rand($especialidades["MC"])];
                    break;
                case "Mercadotecnia":
                    $data["especialidad"] = "Mercadotecnia";
                    break;
            }

            $data["cuatrimestre"] = $cuatrimestres[array_rand($cuatrimestres)];

            $data["turno"] = ($data["cuatrimestre"] == 6) ? "Matutino" : "Vespertino";

            $data["grupo"] = $grupos[$data["cuatrimestre"]][array_rand($grupos[$data["cuatrimestre"]])];

            $data["created_at"] = Carbon::now();
            $data["updated_at"] = Carbon::now();

            DB::table('datos_escolares')->insert($data);
        }
    }
}
