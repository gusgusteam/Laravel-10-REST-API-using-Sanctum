<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
        ];
    }
}
