<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|min:5|max:100|email:rfc,dns',
            'password' => 'required|min:6|max:100'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O campo [email] não está sendo enviado.',
            'email.min' => 'O campo [email] precisa ter no mínimo 5 caracteres.',
            'email.max' => 'O campo [celular] precisa ter no máximo 100 caracteres.',
            'email.email' => 'Digite um email válido!',
            'password.required' => 'O campo [senha] não está sendo enviado.',
            'password.min' => 'O campo [senha] precisa ter no mínimo 6 caracteres.',
            'password.max' => 'O campo [senha] precisa ter no máximo 100 caracteres.',
        ];
    }

}

