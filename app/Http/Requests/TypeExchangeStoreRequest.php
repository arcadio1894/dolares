<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeExchangeStoreRequest extends FormRequest
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
            'buyManual' => 'required|numeric',
            'sellManual' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'buyManual' => 'tipo de cambio compra',
            'sellManual' => 'tipo de cambio venta',
        ];
    }
}
