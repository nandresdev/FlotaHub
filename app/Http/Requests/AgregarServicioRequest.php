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
            'fecha_inicio' => 'required|date|',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'foto' => 'required|mimes:jpeg,jpg,png|max:2048',
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
            'foto.required' => 'El campo :attribute es obligatorio.',
            'fecha_fin.after_or_equal' => 'La :attribute debe ser una fecha posterior o igual a la fecha de inicio.',
            'foto.mimes' => 'El campo :attribute debe ser un archivo de tipo: jpeg, jpg, png.',
            'foto.max' => 'El archivo :attribute no debe superar los 2MB.',
        ];
    }
}