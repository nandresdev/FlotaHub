<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgregarServicioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255|unique:servicios,nombre',
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'nombre servicio',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo :attribute es obligatorio.',
            'nombre.unique' => 'El campo :attribute ya se encuentra registrado.',
        ];
    }
}