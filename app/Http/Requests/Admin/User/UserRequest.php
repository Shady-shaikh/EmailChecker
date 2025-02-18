<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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


        $rules = [
            'name' => 'required|max:110',
            'email' => 'required|max:255',
            'password' => 'confirmed',
        ];


        //for edit and and add
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['email'] = [
                Rule::unique('users')->ignore($this->route()->parameter('user')),
            ];
        } else {
            $rules['password'] .= '|required|min:8|max:255';
            $rules['email'] .= '|unique:users,email';
        }


        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field may not be greater than 110 characters.',
            'email.required' => 'The email field is required.',
            'email.max' => 'The name field may not be greater than 255 characters.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The password must match with confirm password.',
            'password.min' => 'The password field may not be less than 8 characters.',
            'password.max' => 'The password field may not be greater than 255 characters.',
        ];
    }
}
