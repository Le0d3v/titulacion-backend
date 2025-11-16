<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReferenciaRequest extends FormRequest
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
            "referencia_pago" => ["required", "numeric", "digits:20", "unique:archivos,referencia_pago"]
        ];
    }

    public function messages() {
        return [
            "referencia_pago.required" => ["Debes colocar una referencia"],
            "referencia_pago.numeric" => ["La referencia debe contener solo números"],
            "referencia_pago.digits" => ["La referencia debe contener 20 caracteres"],
            "referencia_pago.unique" => ["Esta referencia ya se encuentra registrada"]
        ];
    }
}
