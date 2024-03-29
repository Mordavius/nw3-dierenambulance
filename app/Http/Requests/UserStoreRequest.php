<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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

    public function messages()
    {
        return [
            'name.required' => 'Geen geldige naam ingevoerd.',
            'email.required'  => 'Geen geldige e-mailadres ingevoerd.',
            'password' => 'Geen geldige wachtwoord ingevoerd.',
            'password-confirm' => 'Geen geldige wachtwoord bevestiging ingevoerd.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required',
            'password-confirm' => 'required'
        ];
    }
}