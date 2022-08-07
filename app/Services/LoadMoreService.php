<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

class LoadMoreService
{
    public function generateHtml(LengthAwarePaginator $products): string
    {
        $html = '';

        foreach ($products as $product)
        {
            $html = view('card_product', ['product' => $product])->render();
        }

        return $html;
    }
}
