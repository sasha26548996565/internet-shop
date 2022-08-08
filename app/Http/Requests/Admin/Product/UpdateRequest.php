<?php

namespace App\Http\Requests\Admin\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $product = Product::slug($this->product)->first();

        return [
            'name' => 'required|unique:products,name,' . $product->id,
            'price' => 'required|integer',
            'category_id' => 'required',
            'property_ids' => '',
            'image' => '',
            'new' => '',
            'on_sale' => '',
            'description' => 'required',
            'property_option_ids' => ''
        ];
    }
}
