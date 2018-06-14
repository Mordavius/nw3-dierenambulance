<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email'    => 'email|required|unique:users,email,' . $this->route("leden"),
            'password' => 'required_with:password_confirmation|confirmed'
        ];
    }
}
