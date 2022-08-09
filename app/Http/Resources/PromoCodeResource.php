<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromoCodeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'promo_code' => $this->promo_code,
            'created_at' => $this->created_at
        ];
    }
}
