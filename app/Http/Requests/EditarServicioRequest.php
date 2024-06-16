<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditarServicioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|unique:servicios,nombre,' . $this->route('servicio'),
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'foto' => 'nullable|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'nombre servicio',
            'fecha_inicio' => 'fecha inicio',
            'fecha_fin' => 'fecha fin',
            'foto' => 'foto servicio',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo :attribute es obligatorio.',
            'nombre.unique' => 'El campo :attribute ya se encuentra registrado.',
            'fecha_inicio.required' => 'El campo :attribute es obligatorio.',
            'fecha_fin.required' => 'El campo :attribute es obligatorio.',
            'foto.mimes' => 'El campo :attribute debe ser un archivo de tipo: jpeg, jpg, png.',
            'foto.max' => 'El archivo :attribute no debe superar los 2MB.',
        ];
    }
}