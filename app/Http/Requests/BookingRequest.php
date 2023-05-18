<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    private static $allowedPeoples = array(2, 4, 6, 8, 12);
    private static $allowedEvents = array(1, 2, 3, 4, 5);
    private static $allowedPlaces = array(1, 2);

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
            'user_token' => 'required|exists:users,nm_token',
            'qtd_pessoas' => 'required|in:'.implode(', ', self::$allowedPeoples),
            'tipo_evento' => 'required|in:'.implode(', ', self::$allowedEvents),
            'local' => 'required|in:'.implode(', ', self::$allowedPlaces),
            'data' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d'),
            'hour' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_token.required' => 'Algo de errado aconteceu, recarregue a página ou tente novamente mais tarde.',
            'user_token.exists' => 'Algo de errado aconteceu, recarregue a página ou tente novamente mais tarde.',
            'qtd_pessoas.required' => 'O campo [qtd_pessoas] não está sendo enviado.',
            'qtd_pessoas.in' => 'Algo de errado aconteceu, recarregue a página ou tente novamente mais tarde.',
            'tipo_evento.required' => 'O campo [tipo_evento] não está sendo enviado.',
            'tipo_evento.in' => 'Algo de errado aconteceu, recarregue a página ou tente novamente mais tarde.',
            'local.required' => 'O campo [local] não está sendo enviado.',
            'local.in' => 'Algo de errado aconteceu, recarregue a página ou tente novamente mais tarde.',
            'data.required' => 'O campo [data] não está sendo enviado.',
            'data.date_format' => 'O campo [data] está sendo enviado em formato inválido.',
            'data.after_or_equal' => 'O campo [data] não pode ser inferior a data atual.',
            'hour.required' => 'Você precisa selecionar uma hora para continuar.', 
        ];
    }

}

