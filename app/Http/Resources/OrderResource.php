<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'address_line_2' => $this->address_line_2,
            'phone' => $this->phone,
            'country' => $this->country,
            'zipcode' => $this->zipcode,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'products' => ProductResource::collection($this->products),
            'promo_code' => new PromoCodeResource($this->promoCode),
        ];
    }
}
