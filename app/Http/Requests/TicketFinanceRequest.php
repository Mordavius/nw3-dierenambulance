<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketFinanceRequest extends FormRequest
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
            'payment_invoice.required' => 'Geen geldige betaling ingevoerd',
            'payment_gifts.required'  => 'Geen geldige betaling ingevoerd.',
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
            'payment_invoice' => 'required_if:anotherfield,payment_gifts',
            'payment_gifts' => 'required_if:anotherfield,payment_invoice'
        ];
    }
}