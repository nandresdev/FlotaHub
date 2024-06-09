<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgregarConductoresRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_completo' => 'required|string|unique:conductores|max:255',
            'fecha_nacimiento' => 'required|date|max:255',
            'telefono' => 'required|string|max:255',
            'nacionalidad' => 'required|string|max:255',
            'id_servicios' => 'required|string|max:255',

        ];
    }

    public function attributes()
    {
        return [
            'nombre_completo' => 'nombre completo',
            'fecha_nacimiento' => 'fecha nacimiento',
            'telefono' => 'telefono',
            'nacionalidad' => 'nacionalidad',
            'id_servicios' => 'servicio',
        ];
    }

    public function messages()
    {
        return [
            'nombre_completo.required' => 'El campo :attribute es obligatorio.',
            'fecha_nacimiento.required' => 'El campo :attribute es obligatorio.',
            'telefono.required' => 'El campo :attribute es obligatorio.',
            'nacionalidad.required' => 'El campo :attribute es obligatorio.',
            'id_servicios.required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
