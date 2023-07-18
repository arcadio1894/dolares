<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountCustomerUpdateRequest extends FormRequest
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
            'account_id' => 'required|exists:account_customers,id',
            'bank_id' => 'required|exists:banks,id',
            'department_id' => 'required|exists:departments,id',
            'numberAccount' => 'required|numeric|max:255|unique:account_customers,numberAccount,'.$this->get('account_id'),
            'nameAccount' => 'required|string|max:255|unique:account_customers,nameAccount,'.$this->get('account_id'),
            'currency' => 'required',
            'type_account' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'account_id' => 'ID de la cuenta',
            'bank_id' => 'ID del banco',
            'department_id' => 'ID del departamento',
            'nameAccount' => 'nombre de la cuenta',
            'numberAccount' => 'número de la cuenta',
            'currency' => 'moneda de la cuenta',
            'type_account' => 'tipo de la cuenta',
        ];
    }
}
