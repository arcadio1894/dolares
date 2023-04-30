<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountDolareroUpdateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_id' => 'required|exists:account_dolareros,id',
            'bank_id' => 'required|exists:banks,id',
            'numberAccount' => 'required|string|max:255|unique:account_dolareros,numberAccount,'.$this->get('account_id'),
            'currency' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'account_id' => 'ID de la cuenta',
            'bank_id' => 'ID del banco',
            'numberAccount' => 'número de la cuenta',
            'currency' => 'moneda de la cuenta'
        ];
    }
}
