<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id'); 
        $rules = (new StoreRoleRequest())->rules(); 
        $rules['name'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('roles')->ignore($id),
        ];

        return $rules;
    }

    public function messages()
    {
        return (new StoreRoleRequest())->messages();
    }
}

