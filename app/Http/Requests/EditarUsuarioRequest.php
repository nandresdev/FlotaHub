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

    public function rules(Request $request): array
    {
        $userId = Auth::id();
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],       'password' => 'required|string|min:3|max:255',
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
