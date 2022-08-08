<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): View
    {
        $products = Product::latest()->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.product.form');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $product = $this->productService->store($request->validated());

        return to_route('admin.product.show', $product->slug);
    }

    public function show(string $productSlug): View
    {
        $product = Product::slug($productSlug)->first();

        return view('admin.product.show', compact('product'));
    }

    public function edit(string $productSlug): View
    {
        $product = Product::slug($productSlug)->first();

        return view('admin.product.form', compact('product'));
    }

    public function update(UpdateRequest $request, string $productSlug): RedirectResponse
    {
        $product = Product::slug($productSlug)->first();
        $this->productService->update($request->validated(), $product);

        return to_route('admin.product.show', $product->slug);
    }

    public function destroy(string $productSlug): RedirectResponse
    {
        $product = Product::slug($productSlug)->first();
        $product->delete();

        return to_route('admin.product.index');
    }
}
