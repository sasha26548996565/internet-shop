<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $newProducts = Product::with('category')->latest()->take(2)->get();
        $categories = Category::latest()->get();
        $latestProducts = Product::with('category')->latest()->take(5)->get();

        return view('index', compact('newProducts', 'latestProducts', 'categories'));
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
