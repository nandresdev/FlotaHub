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
        $servicioId = $this->route('servicio');

        return [
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('servicios')->ignore($servicioId)
            ],
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
