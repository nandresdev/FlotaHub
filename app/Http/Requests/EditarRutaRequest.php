<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarRutaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_servicio' => 'required|max:255',
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'id_servicio' => 'servicio',
            'origen' => 'origen',
            'destino' => 'destino',
        ];
    }

    public function messages()
    {
        return [
            'id_servicio.required' => 'El campo :attribute es obligatorio.',
            'origen.required' => 'El campo :attribute es obligatorio.',
            'destino.required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
