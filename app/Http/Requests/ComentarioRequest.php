<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentarioRequest extends FormRequest
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
            "proceso_id" => ["required", "numeric"],
            "comentario" => ["required", "string"],
            "subproceso" => ["required", "string"],
        ];
    }

    public function messages() 
    {
        return [
            "comentario.required" => ["El Comentario es requerido"], 
            "comentario.string" => ["El formato de comentario no es válido"],
            "comentario.max" => ["El comentario extiende el límite de caracteres"]
        ];
    }
}
