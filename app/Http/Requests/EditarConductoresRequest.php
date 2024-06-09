<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditarConductoresRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $conductorId = $this->route('conductor');

        return [
            'nombre_completo' => 'required|string|max:255',
            Rule::unique('conductores')->ignore($conductorId),
            'fecha_nacimiento' => 'required|date|max:255',
            'telefono' => 'required|string|max:255',
            'nacionalidad' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'nombre_completo' => 'nombre completo',
            'fecha_nacimiento' => 'fecha nacimiento',
            'telefono' => 'telefono',
            'nacionalidad' => 'nacionalidad',

        ];
    }

    public function messages()
    {
        return [
            'nombre_completo.required' => 'El campo :attribute es obligatorio.',
            'fecha_nacimiento.required' => 'El campo :attribute es obligatorio.',
            'telefono.required' => 'El campo :attribute es obligatorio.',
            'nacionalidad.required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
