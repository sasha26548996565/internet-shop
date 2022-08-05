<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromoCodeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'promo_code' => 'required|exists:promo_codes,promo_code',
        ];
    }

    public function messages()
    {
        return [
            'promo_code.*' => 'Promo code does not exists!',
        ];
    }
}
