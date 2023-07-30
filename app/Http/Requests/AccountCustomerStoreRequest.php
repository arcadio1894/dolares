<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AccountCustomerStoreRequest extends FormRequest
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
            'numberAccount' => 'required|numeric|unique:account_customers,numberAccount',
            'nameAccount' => 'required|string|max:255|unique:account_customers,nameAccount,'.Auth::id().',id,user_id,'.Auth::id(),
            'bank_id' => 'required|exists:banks,id',
            'department_id' => 'required|exists:departments,id',
            'currency' => 'required',
            'type_account' => 'required',
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
            'nameAccount' => 'nombre de la cuenta',
            'numberAccount' => 'número de la cuenta',
            'bank_id' => 'banco de la cuenta',
            'department_id' => 'departamento de la cuenta',
            'currency' => 'moneda de la cuenta',
            'type_account' => 'tipo de cuenta'
        ];
    }
}
