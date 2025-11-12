<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            "matricula" => $this->matricula,
            "email" => $this->email,
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
        ];
    }
}
