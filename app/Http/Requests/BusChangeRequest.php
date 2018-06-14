<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusChangeRequest extends FormRequest
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
            'bus_type.required' => 'Geen voertuig ingevoerd.',
            'milage.required'  => 'Geen kilometerstand ingevoerd.',
            'milage.numeric'  => 'Geen numerieke kilometerstand ingevoerd.',
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
            'bus_type'     => 'required',
            'milage'    => 'required|numeric'
        ];
    }
}