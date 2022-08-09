<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\LoadMoreService;
use App\Http\Filters\ProductFilter;
use Illuminate\Contracts\View\View;
use Barryvdh\Debugbar\Facades\Debugbar;

class MainController extends Controller
{
    private LoadMoreService $loadMoreService;

    public function __construct(LoadMoreService $loadMoreService)
    {
        $this->loadMoreService = $loadMoreService;
    }

    public function index(Request $request): View|string
    {
        $latestProducts = Product::with('category')->orderBy('id', 'DESC')->paginate(4);

        if ($request->ajax())
        {
            $html = $this->loadMoreService->generateHtml($latestProducts);

            return $html;
        }

        return view('index', compact('latestProducts'));
    }

    public function category(Request $request, string $categorySlug): View|string
    {
        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($request->all())]);
        $category = Category::where('slug', $categorySlug)->first();
        $products = Product::with('category')->where('category_id', $category->id)->filter($filter)->paginate(4);

        if ($request->ajax())
        {
            $html = $this->loadMoreService->generateHtml($products);

            return $html;
        }

        return view('category', compact('category', 'products'));
    }

    public function product(string $productSlug): View
    {
        $product = Product::where('slug', $productSlug)->first();

        return view('product', compact('product'));
    }
}
