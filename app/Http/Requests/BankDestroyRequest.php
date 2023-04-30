<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankDestroyRequest extends FormRequest
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
            'bank_id' => 'required|exists:banks,id',
        ];
    }

    public function attributes()
    {
        return [
            'bank_id' => 'ID del banco'
        ];
    }
}
