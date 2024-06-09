<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgregarVehiculoRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_vehiculo' => 'required|string|max:255',
            'patente' => 'required|string|unique:vehiculos|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'combustible' => 'required|string|max:255',
            'ano' => 'required|string|max:255',
            'traccion' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'numero_motor' => 'required|string|max:255',
            'numero_chasis' => 'required|string|max:255',
            'kilometraje' => 'required|string|max:255',
            'id_servicios' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'tipo_vehiculo' => 'tipo vehiculo',
            'patente' => 'patente',
            'marca' => 'marca',
            'modelo' => 'modelo',
            'combustible' => 'combustible',
            'ano' => 'ano',
            'traccion' => 'traccion',
            'color' => 'color',
            'numero_motor' => 'numero de motor',
            'numero_chasis' => 'numero de chasis',
            'kilometraje' => 'kilometraje',
            'id_servicios' => 'servicio',

        ];
    }

    public function messages()
    {
        return [
            'tipo_vehiculo.required' => 'El campo :attribute es obligatorio.',
            'patente.required' => 'El campo :attribute es obligatorio.',
            'marca.required' => 'El campo :attribute es obligatorio.',
            'modelo.required' => 'El campo :attribute es obligatorio.',
            'combustible.required' => 'El campo :attribute es obligatorio.',
            'ano.required' => 'El campo :attribute es obligatorio.',
            'traccion.required' => 'El campo :attribute es obligatorio.',
            'color.required' => 'El campo :attribute es obligatorio.',
            'numero_motor.required' => 'El campo :attribute es obligatorio.',
            'numero_chasis.required' => 'El campo :attribute es obligatorio.',
            'id_servicios.required' => 'El campo :attribute es obligatorio.',

        ];
    }
}
