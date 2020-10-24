<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UiMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'bail|required|email|max:255',
            'message' => 'required|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => "Inserisci l'email",
            'email.email' => "Email non valida",
            'email.max' => "Email troppo lunga",
            'message.required' => 'Inserisci il testo del messaggio',
            'message.max' => 'Consentiti massimo 1000 caratteri'
        ];
    }
}
