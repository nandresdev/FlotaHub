<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class EditarUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $this->route('usuario'),
            'password' => 'nullable|string|min:3|max:255',
            'foto_perfil' => 'nullable|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre completo',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'foto_perfil' => 'foto perfil',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo :attribute es obligatorio.',
            'email.required' => 'El campo :attribute es obligatorio.',
            'password.required' => 'El campo :attribute es obligatorio.',
            'foto_perfil.required' => 'El campo :attribute es obligatorio.',
            'foto_perfil.max' => 'El archivo :attribute no debe superar los 2MB.',

        ];
    }
}