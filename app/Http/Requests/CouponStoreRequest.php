<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:coupons,name',
            'amountSell' => 'required|numeric',
            'amountBuy' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre del cupón',
            'amountSell' => 'monto venta',
            'amountBuy' => 'monto compra',
        ];
    }
}
