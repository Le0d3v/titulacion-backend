<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id" => ["required", "numeric"],
            "name" => ["required", "string"],
            "apellido_paterno" => ["required", "string"],
            "apellido_materno" => ["required", "string"],
            "fecha_nacimiento" => ["required", "date"],
            "curp" => ["required", "string",],
            "rfc" => ["required", "string",],
            "genero" => ["required", "string"],
            "estado_civil" => ["required", "string"],
            "email" => ["required", "email",], 
            "telefono" => ["required"], 
            "telefono_emergencia_1" => ["required"], 
            "telefono_emergencia_2" => ["required"], 
        ];
    }

    public function messages()
    {
        return [
            "name.required" => ["El nombre es requerido"],
            "name.string" => ["El formato del nombre no es válido"],
            "apellido_paterno.required" => ["El apellido paterno es requerido"],
            "apellido_paterno.string" => ["El formato del apellido paterno no es válido"],
            "apellido_materno.required" => ["El apellido materno es requerido"],
            "apellido_materno.strng" => ["El formato del apellido materno no es válido"],
            "fecha_nacimiento.required" => ["La fecha de nacimiento es requerida"],
            "fecha_nacimiento.date" => ["El formato de la fecha de nacimiento no es válido"],
            "curp.required" => ["El curp es requerido"],
            "curp.string" => ["El formato del curp no es válido"],
            "rfc.required" => ["El rfc es requerido"],
            "rfc.string" => ["El formato del rfc no es válido"],
            "genero.required" => ["El genero es requerido"],
            "genero.string" => ["El formato del genero no es válido"],
            "estado_civil.required" => ["El estado civil es requerido"],
            "estado_civil.string" => ["El formato del estado civil no es válido"],
            "email.required" => ["El email es requerido"],
            "email.email" => ["El formato del email no es válido"],
            "telefono.required" => ["El número de telefono es requerido"],
            "telefono_emergencia_1.required" => ["El número de telefono de emergencia (1) es requerido"],
            "telefono_emergencia_2.required" => ["El número de telefono de emergencia (2) es requerido"],
        ];
    }
}
