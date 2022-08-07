<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\LoadMoreService;
use Illuminate\Contracts\View\View;
use App\Http\Requests\SearchRequest;
use Barryvdh\Debugbar\Facades\Debugbar;

class SearchController extends Controller
{
    private LoadMoreService $loadMoreService;

    public function __construct(LoadMoreService $loadMoreService)
    {
        $this->loadMoreService = $loadMoreService;
    }

    public function __invoke(Request $request): View|string
    {
        $products = Product::with('category')->where('name', 'like', '%'. $request->search .'%')->paginate(4);

        if ($request->ajax())
        {
            $html = $this->loadMoreService->generateHtml($products);

            return $html;
        }

        return view('search', compact('products'));
    }
}
