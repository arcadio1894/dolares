<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
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
            'coupon_id' => 'required|exists:coupons,id',
            'name' => 'required|string|max:255|unique:coupons,name,'.$this->get('coupon_id'),
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
