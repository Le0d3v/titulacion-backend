<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "apellido_paterno" => $this->apellido_paterno,
            "apellido_materno" => $this->apellido_materno,
            "fecha_nacimiento" => $this->fecha_nacimiento,
            "curp" => $this->curp,
            "rfc" => $this->rfc,
            "email" => $this->email,
            "password" => $this->password,
            "telefono" => $this->telefono,
            "telefono_emergencia_1" => $this->telefono_emergencia_1,
            "telefono_emergencia_2" => $this->telefono_emergencia_2,
            "genero" => $this->genero,
            "estado_civil" => $this->estado_civil,

            "domicilio" => [
                "calle" => $this->domicilio->calle,
                "numero_exterior" => $this->domicilio->numero_exterior,
                "numero_interior" => $this->domicilio->numero_interior,
                "colonia" => $this->domicilio->colonia,
                "municipio" => $this->domicilio->municipio,
                "estado" => $this->domicilio->estado,
                "codigo_postal" => $this->domicilio->codigo_postal,
                "pais" => $this->domicilio->pais,
            ],

            "datos_escolares" => [
                "matricula" => $this->matricula,
                "carrera" => $this->datos_escolares->carrera,
                "especialidad" => $this->datos_escolares->especialidad,
                "cuatrimestre" => $this->datos_escolares->cuatrimestre,
                "turno" => $this->datos_escolares->turno,
                "grupo" => $this->datos_escolares->grupo,
            ], 

            "proceso" => [
                "validacion_memoria_estadia" => $this->proceso->validacion_memoria_estadia,
                "validacion_datos_personales" => $this->proceso->validacion_datos_personales,
                "encuesta_egresados" => $this->proceso->encuesta_egresados,
                "carga_imagen" => $this->proceso->carga_imagen,
                "pago_donacion" => $this->proceso->pago_donacion,
                "pago_titulo" => $this->proceso->pago_titulo,
                "completado" => $this->proceso->completado,
            ],

           "archivo" => [
                "memoria_estadia" => $this->archivo->memoria_estadia,
                "imagen_titulacion" => $this->archivo->imagen_titulacion,
                "comprobante_donacion" => $this->archivo->comprobante_donacion,
                "referencia_pago" => $this->archivo->referencia_pago,
           ], 

           "comentarios" => [
            "comentarios_memoria" => $this->comentarioProceso("memoria"),
            "comentarios_comprobante" => $this->comentarioProceso("comprobante"),
            "comentarios_imagen" => $this->comentarioProceso("imagen"),
            "comentarios_referencia" => $this->comentarioProceso("titulo"),
           ]
        ];
    }
}
