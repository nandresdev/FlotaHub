<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgregarUsuarioRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:3|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre completo',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo :attribute es obligatorio.',
            'email.required' => 'El campo :attribute es obligatorio.',
            'password.required' => 'El campo :attribute es obligatorio.',
        ];
    }
}
