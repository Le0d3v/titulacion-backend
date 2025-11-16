<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PDFRequest extends FormRequest
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
            "pdf" => ["required", "max:20480"]
        ];
    }

    public function messages()
    {
        return [
            "pdf.requirded" => ["Debes colcocar un archivo .pdf"],
            "pdf.mimes" => ["El archivo debe ser un PDF"],
            "pdf.max" => ["El archivo debe pesar menos de 20mb"],
        ];
    }
}
