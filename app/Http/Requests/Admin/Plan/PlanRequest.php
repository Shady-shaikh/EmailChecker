<?php

namespace App\Http\Requests\Admin\Plan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanRequest extends FormRequest
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
            'description' => 'max:255',
            'price' => 'required|integer',
            'email_limit' => 'required|integer',
        ];


        //for edit and and add
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['name'] = [
                'required',
                'max:110',
                Rule::unique('plans')->ignore($this->route()->parameter('plan')),
            ];
        } else {
            $rules['name'] .= '|unique:plans,name';
        }


        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field may not be greater than 110 characters.',
            'name.unique' => 'The name field must be unique.',
            'price.required' => 'The price field is required.',
            'price.integer' => 'The price field must be integer.',
            'description.max' => 'The description field may not be greater than 255 characters.',
        ];
    }
}
