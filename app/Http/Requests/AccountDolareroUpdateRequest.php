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
            'department_id' => 'required|exists:departments,id',
            'bank_id' => 'required|exists:banks,id',
            'numberAccount' => 'required|numeric|unique:account_dolareros,numberAccount,'.$this->get('account_id'),
            'currency' => 'required',
            'number_interbank' => 'numeric|unique:account_dolareros,number_interbank,'.$this->get('account_id'),
            'balance' => 'numeric'
        ];
    }

    public function attributes()
    {
        return [
            'account_id' => 'ID de la cuenta',
            'bank_id' => 'ID del banco',
            'department_id' => 'ID del departmento',
            'numberAccount' => 'número de la cuenta',
            'currency' => 'moneda de la cuenta',
            'number_interbank' => 'número interbancario',
            'balance' => 'balance'
        ];
    }
}
