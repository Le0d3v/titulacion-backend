<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres = [
            "Sofía", "Mateo", "Camila", "Diego", "Valentina",
            "Sebastián", "Mariana", "Alejandro", "Valeria", "Daniel",
            "Ximena", "Fernando", "Lucía", "Emiliano", "Paola",
            "Andrés", "Isabella", "Javier", "Renata", "Carlos",
            "María", "Luis", "Natalia", "Gabriel", "Ana",
            "Arturo", "Salma", "Diego", "Victoria", "Pablo",
            "Elena", "Ricardo", "Karen", "Julio", "Claudia",
            "Hugo", "Sara", "Victor", "Monserrat", "Alberto",
            "Lía", "Iván", "Carmen", "Rafael", "Tania",
            "Mauro", "Diana", "Cristian", "Alicia", "José",
            "Gina", "Ernesto", "Marisol", "Felipe", "Rosario",
            "Nicolás", "Bárbara", "Omar", "Leticia", "Jazmín",
            "Santiago", "Ana Sofía", "Diego Armando", "Martha", "Alma",
            "Esteban", "Patricia", "Fernando", "Cecilia", "Jorge",
            "Gabriela", "Saúl", "Verónica", "Leonardo", "Gloria",
            "Ángel", "Silvia", "Cristina", "Estefanía", "Raúl",
            "Lucero", "Adrián", "Mireya", "Salvador", "Susana",
            "Marco", "Irma", "Leonor", "Enrique", "Teresa",
            "César", "Graciela", "Rocío", "Fabián", "Lourdes",
            "Nadia", "Joaquín", "Pamela", "Ezequiel", "Cinthia",
            "Ramiro", "Yolanda", "Sergio", "María José", "Denisse",
            "Felicia", "Octavio", "Ariana", "Mauricio", "Verónica"
        ];

        $apellidos = [
            "Hernández", "García", "Martínez", "López", "Pérez",
            "Sánchez", "Ramírez", "Torres", "Flores", "González",
            "Morales", "Reyes", "Cruz", "Jiménez", "Mendoza",
            "Rojas", "Vázquez", "Gutiérrez", "Salazar", "Ortega",
            "Castillo", "Aguilar", "Delgado", "Nava", "Carrillo",
            "Córdoba", "Ponce", "Valdez", "Serrano", "Luna",
            "Bermúdez", "Ríos", "Montoya", "Salinas", "Pacheco",
            "Cisneros", "Cantu", "Alvarado", "Bravo", "Soto",
            "Martín", "Vega", "Zamora", "Cruz", "Bautista",
            "Hinojosa", "Sandoval", "Hernández", "Esquivel", "Mora",
            "Valencia", "Salas", "Aguirre", "Márquez", "Camacho",
            "Villarreal", "Salgado", "Rangel", "Cervantes", "Núñez",
            "Cárdenas", "López", "Medina", "Orozco", "Saldivar",
            "Cortez", "Gonzales", "Ibarra", "Peña", "Fuentes",
            "Lara", "Sierra", "Jiménez", "Rivas", "Peñaloza",
            "Maldonado", "Téllez", "Ramos", "Gonzalez", "Cano",
            "Cruz", "Martínez", "Aguilera", "Pérez", "Hernández",
            "Alonso", "Ríos", "Pérez", "López", "González",
            "Sánchez", "Ramírez", "Torres", "Flores", "González"
        ];

        $generos = ["H", "M"];

        $estados_civiles = [
            "soltero", "casado", "divorciado"
        ];

        $estudiantes = [];
        $admins = [];
        $matriculasExistentes = [];

        function generarMatricula(&$matriculasExistentes) {
            // Prefijo fijo + random entre 22 y 21 + "11"
            $matricula = "35" . rand(22, 21) . "11";

            do {
                // Genera 4 dígitos aleatorios
                $matriculaGenerada = $matricula;
                for ($i = 0; $i < 4; $i++) {
                    $matriculaGenerada .= rand(0, 9);
                }
            } while (in_array($matriculaGenerada, $matriculasExistentes));

            // Guardar para evitar duplicados
            $matriculasExistentes[] = $matriculaGenerada;

            return $matriculaGenerada;
        }


        function quitarAcentos($texto) {
            $acentos = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
            $sinAcentos = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
            return str_replace($acentos, $sinAcentos, $texto);
        }

        function generarCURP($nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo) {

            $apellidoPaterno = quitarAcentos($apellidoPaterno);
            $apellidoMaterno = quitarAcentos($apellidoMaterno);
            $nombre = quitarAcentos($nombre);

            $curp = strtoupper(substr($apellidoPaterno, 0, 1));

            preg_match('/[AEIOU]/', strtoupper(substr($apellidoPaterno, 1)), $vocales);
            $curp .= strtoupper(substr($vocales[0], 0, 1));
            $curp .= strtoupper(substr($apellidoMaterno, 0, 1));
            $curp .= strtoupper(substr($nombre, 0, 1));
            
            $fecha = Carbon::parse($fechaNacimiento);
            $curp .= $fecha->format('ymd');
            
            $curp .= ($sexo === 'M') ? 'M' : 'H';

            $codigosEstado = [
                'AS', 'BC', 'BS', 'CM', 'CS', 'CH', 'CO', 'CL', 'DG', 'GT',
                'GR', 'HG', 'JA', 'MC', 'MN', 'MS', 'NT', 'NL', 'OC', 'PB',
                'QT', 'QR', 'SP', 'SL', 'SR', 'TC', 'TS', 'TL', 'VE', 'YU',
                'ZS', 'DF'
            ];

            $codigoEstadoAleatorio = $codigosEstado[array_rand($codigosEstado)];
            $curp .= $codigoEstadoAleatorio;

            $ultimosCaracteres = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); 
            $curp .= $ultimosCaracteres;

            return $curp;
        }

        function generarRFC($curp) {
            if (strlen($curp) < 10) {
                return "CURP inválido. Debe tener al menos 10 caracteres.";
            }

            $rfcBase = substr($curp, 0, 10);

            $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $digitosAleatorios = '';

            for ($i = 0; $i < 3; $i++) {
                $digitosAleatorios .= $caracteres[random_int(0, strlen($caracteres) - 1)];
            }

            $rfcFinal = strtoupper($rfcBase . $digitosAleatorios);

            return $rfcFinal;
        }

        function crearEmail($matricula) {
            $matricula = "$matricula@uth.edu.mx";

            return $matricula;
        }

        for ($i = 1; $i < 5; $i++) {
            $nombre = $nombres[array_rand($nombres)];
            $apellidoPaterno = $apellidos[array_rand($apellidos)];
            $apellidoMaterno = $apellidos[array_rand($apellidos)];
            $fechaNacimiento = fake()->date();
            $genero = $generos[array_rand($generos)];
            $curp = generarCURP($nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $genero);
            $rfc = generarRFC($curp);
            $matricula = generarMatricula($matriculasExistentes);
            $email = crearEmail($matricula);

            $admins[] = [
                "name" => $nombre,
                "email" => $email,
                "password" => Hash::make("12345678"),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "apellido_paterno" => $apellidoPaterno,
                "apellido_materno" => $apellidoMaterno,
                "fecha_nacimiento" => $fechaNacimiento,
                "matricula" => $matricula,
                "curp" => $curp,
                "rfc" => $rfc,
                "telefono" => fake("es-MX")->unique()->phoneNumber(),
                "genero" => $genero,
                "estado_civil" => $estados_civiles[array_rand($estados_civiles)],
                "telefono_emergencia_1" => fake("es-MX")->unique()->phoneNumber(),
                "telefono_emergencia_2" => fake("es-MX")->unique()->phoneNumber(),
                "domicilio_id" => $i,
                "datos_escolares_id" => $i,
                "proceso_id" => $i,
                "archivo_id" => $i,
                "admin" => 1
            ];
        }
        
        for ($i = 5; $i < 729; $i++) {
            $nombre = $nombres[array_rand($nombres)];
            $apellidoPaterno = $apellidos[array_rand($apellidos)];
            $apellidoMaterno = $apellidos[array_rand($apellidos)];
            $fechaNacimiento = fake()->date();
            $genero = $generos[array_rand($generos)];
            $curp = generarCURP($nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $genero);
            $rfc = generarRFC($curp);
            $matricula = generarMatricula($matriculasExistentes);
            $email = crearEmail($matricula);

            $estudiantes[] = [
                "name" => $nombre,
                "email" => $email,
                "password" => Hash::make("12345678"),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "apellido_paterno" => $apellidoPaterno,
                "apellido_materno" => $apellidoMaterno,
                "fecha_nacimiento" => $fechaNacimiento,
                "matricula" => $matricula,
                "curp" => $curp,
                "rfc" => $rfc,
                "telefono" => fake("es ")->unique()->phoneNumber(),
                "genero" => $genero,
                "estado_civil" => $estados_civiles[array_rand($estados_civiles)],
                "telefono_emergencia_1" => fake("es-MX")->unique()->phoneNumber(),
                "telefono_emergencia_2" => fake("es-MX")->unique()->phoneNumber(),
                "domicilio_id" => $i,
                "datos_escolares_id" => $i,
                "proceso_id" => $i,
                "archivo_id" => $i,
                "admin" => 0
            ];
        }

        DB::table("users")->insert($admins);
        DB::table("users")->insert($estudiantes);
    }
}
