<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class PasswordRequest extends FormRequest
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
            "current_password" => ["required"],
            "password" => [
                "required",
                "confirmed",
                PasswordRules::min(8)->letters()->numbers()->symbols()
            ],
        ];
    }

    public function messages() {
        return [
            "current_password.required" => "Tu contraseña actual es requerida",
            "password.required" => "Tu nueva contraseña es requerida",
            "password.min" => "Tu nueva contraseña debe contener 8 caracteres como mínimo",
            "password.confirmed" => "Las contraseñas no coinciden",
            "password.password" => "Las contraseña debe incluir letras, números y carácteres especiales"
        ];
    }
}
