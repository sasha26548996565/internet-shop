<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Services\LoadMoreService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Barryvdh\Debugbar\Facades\Debugbar;

class MainController extends Controller
{
    private LoadMoreService $loadMoreService;

    public function __construct(LoadMoreService $loadMoreService)
    {
        $this->loadMoreService = $loadMoreService;
    }

    public function index(Request $request)
    {
        $latestProducts = Product::with('category')->orderBy('id', 'DESC')->paginate(4);

        if ($request->ajax())
        {
            $html = $this->loadMoreService->generateHtml($latestProducts);

            return $html;
        }

        return view('index', compact('latestProducts'));
    }

    public function category(string $categorySlug): View
    {
        $category = Category::where('slug', $categorySlug)->first();
        $products = Product::with('category')->where('category_id', $category->id)->get();

        return view('category', compact('category', 'products'));
    }

    public function product(string $productSlug): View
    {
        $product = Product::where('slug', $productSlug)->first();

        return view('product', compact('product'));
    }
}
