<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'nome_completo' => 'required||min:5|max:100',
            'celular' => 'required|min:15|max:15',
            'email' => 'required|min:5|max:100|email:rfc,dns',
            'mensagem' => 'required|min:3|max:1000',
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
            'email.email' => 'Digite um email válido!',
            'mensagem.required' => 'O campo [mensagem] não está sendo enviado.',
            'mensagem.min' => 'O campo [mensagem] precisa 3 caracteres.',
            'mensagem.max' => 'O campo [mensagem] precisa ter 1000 caracteres.',
        ];
    }

}

