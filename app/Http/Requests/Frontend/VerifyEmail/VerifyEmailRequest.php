<?php

namespace App\Http\Requests\Frontend\VerifyEmail;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
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
            'type' => 'required|in:single,csv',
        ];

        if($this->type == 'single'){
            // $rules['email'] = 'required_if:type,single|email:rfc,dns';
        }
        else{
            $rules['csv_file'] = 'required_if:type,csv|mimes:csv,txt';
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Please provide email verification type.',
            'type.in' => 'Please provide a valid email verification type.',
            'email.required_if' => 'Please provide an email address.',
            'email.email' => 'Please enter a valid email address.',
            'csv_file.required_if' => 'Please provide a csv file.',
            'csv_file.mimes' => 'Please provide a valid csv file.',
        ];
    }
}
