<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KnownAddressRequest extends FormRequest
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
            'location_name.required' => 'Geen geldige locatie ingevoerd.',
            'postal_code.required'  => 'Geen geldige postcode ingevoerd.',
            'address.required' => 'Geen geldige straatnaam ingevoerd.',
            'house_number.required' => 'Geen geldig huisnummer ingevoerd.',
            'house_number.numeric' => 'Huisnummer dient een nummer te zijn.',
            'city.required' => 'Geen geldige stad ingevoerd.',
            'township.required' => 'Geen geldige gemeente ingevoerd.',
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
            'location_name' => 'required',
            'postal_code'  => 'required',
            'address' => 'required',
            'house_number' => 'required|numeric',
            'city' => 'required',
            'township' => 'required',
        ];
    }
}