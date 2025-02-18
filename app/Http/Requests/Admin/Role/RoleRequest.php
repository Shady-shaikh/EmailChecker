<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules =  [
            'name' => 'required|max:255',
            'display_name' => 'nullable|max:255',
            'description' => 'nullable|max:255',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['name'] = [
                Rule::unique('roles')->ignore($this->route()->parameter('role')),
            ];
        } else {
            $rules['name'] .= '|unique:roles,name';
        }


        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field may not be greater than 255 characters.',
            'name.unique' => 'The name field must be unique',
            'display_name.max' => 'The display name field may not be greater than 255 characters.',
            'description.max' => 'The description field may not be greater than 255 characters.',
        ];
    }
}
