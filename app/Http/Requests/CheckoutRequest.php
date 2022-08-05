<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address' => 'required',
            'address_line_2' => 'required',
            'phone' => '',
            'zipcode' => 'required|min:6|max:8',
            'shipping' => '',
            'country' => 'required'
        ];
    }
}
