<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImagenRequest extends FormRequest
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
            "imagen" => ["required", "image"]
        ];
    }

    public function messages() {
        return [
            "imagen.require" => ["La imágen es requerida"], 
            "imagen.image" => ["El archivo debe de ser una imágen"]
        ];
    }
}
