<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id'); 
        $rules = (new StorePermissionRequest())->rules(); 
        $rules['name'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('permissions', 'name')->ignore($id),
        ];

        return $rules;
    }

    public function messages()
    {
        return (new StorePermissionRequest())->messages();
    }
}

