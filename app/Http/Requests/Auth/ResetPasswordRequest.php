<?php
// app/Http/Requests/ResetPasswordRequest.php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'token.required' => 'El token es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
}

