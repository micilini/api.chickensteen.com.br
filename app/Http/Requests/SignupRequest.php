<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'nome_completo' => 'required|min:5|max:100',
            'celular' => 'required|min:15|max:15',
            'email' => 'required|min:5|max:100|email:rfc,dns|unique:users,nm_email',
            'password' => 'required|min:6|max:100|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'nome_completo.required' => 'O campo [nome_completo] não está sendo enviado.',
            'nome_completo.min' => 'O campo [nome_completo] precisa ter no mínimo 5 caracteres.',
            'nome_completo.max' => 'O campo [nome_completo] precisa ter no máximo 100 caracteres.',
            'celular.required' => 'O campo [celular] não está sendo enviado.',
            'celular.min' => 'O campo [celular] precisa 15 caracteres.',
            'celular.max' => 'O campo [celular] precisa ter 15 caracteres.',
            'email.required' => 'O campo [email] não está sendo enviado.',
            'email.min' => 'O campo [email] precisa ter no mínimo 5 caracteres.',
            'email.max' => 'O campo [celular] precisa ter no máximo 100 caracteres.',
            'email.unique' => 'Parece que o email informado já existe no sistema.',
            'email.email' => 'Digite um email válido!',
            'password.required' => 'O campo [senha] não está sendo enviado.',
            'password.min' => 'O campo [senha] precisa ter no mínimo 6 caracteres.',
            'password.max' => 'O campo [senha] precisa ter no máximo 100 caracteres.',
            'password.confirmed' => 'As senhas digitadas não coincidem.'
        ];
    }

}

