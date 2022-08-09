<?php

namespace App\Http\Requests\Admin\Product;

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
            'name' => 'required|unique:products,name',
            'price' => 'required|integer',
            'category_id' => 'required',
            'property_ids' => '',
            'image' => 'required',
            'new' => '',
            'on_sale' => '',
            'description' => 'required',
            'count' => 'required|integer'
        ];
    }
}
