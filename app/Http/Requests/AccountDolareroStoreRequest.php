<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountDolareroStoreRequest extends FormRequest
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
            'numberAccount' => 'required|numeric|unique:account_dolareros,numberAccount',
            'bank_id' => 'required|exists:banks,id',
            'department_id' => 'required|exists:departments,id',
            'currency' => 'required',
            'number_interbank' => 'numeric|unique:account_dolareros,number_interbank',
            'balance' => 'numeric'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'numberAccount' => 'número de la cuenta',
            'bank_id' => 'banco de la cuenta',
            'department_id' => 'departemento de la cuenta',
            'currency' => 'moneda de la cuenta',
            'number_interbank' => 'número interbancario',
            'balance' => 'balance'
        ];
    }
}
