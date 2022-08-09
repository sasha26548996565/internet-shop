<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address' => 'nullable',
            'address_line_2' => 'nullable',
            'phone' => 'nullable',
            'country' => 'nullable',
            'zipcode' => 'nullable|min:6|max:8',
            'status' => 'nullable|boolean',
            'created_at' => '',
        ];
    }
}
