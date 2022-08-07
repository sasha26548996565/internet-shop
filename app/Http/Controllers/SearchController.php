<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
    public function __invoke(Request $request): View|string
    {
        $newProducts = Product::with('category')->latest()->take(2)->get();
        $products = Product::with('category')->where('name', 'like', '%'. $request->search .'%')->paginate(4);
        $categories = Category::latest()->get();

        if ($request->ajax())
        {
            $html = '';

            foreach ($products as $product)
            {
                $html = view('card_product', ['product' => $product])->render();
            }

            return $html;
        }

        return view('search', compact('products', 'newProducts', 'categories'));
    }
}
