<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'phone' => 'nullable',
            'country' => 'required',
            'zipcode' => 'required|min:6|max:8',
            'status' => 'required|boolean',
            'created_at' => '',
        ];
    }
}
