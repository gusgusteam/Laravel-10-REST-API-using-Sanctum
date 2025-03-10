<?php

namespace App\Http\Requests\Envase;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnvaseRequest extends FormRequest
{
    public function rules(): array
    {
        return (new StoreEnvaseRequest())->rules();
    }

    public function messages(): array
    {
        return (new StoreEnvaseRequest())->messages();
    }

    public function authorize(): bool
    {
        return true;
    }
}

