<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.category.form');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());

        return to_route('admin.category.show', $category->slug);
    }

    public function show(string $categorySlug): View
    {
        $category = Category::slug($categorySlug)->first();

        return view('admin.category.show', compact('category'));
    }

    public function edit(string $categorySlug): View
    {
        $category = Category::slug($categorySlug)->first();

        return view('admin.category.form', compact('category'));
    }

    public function update(UpdateRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return to_route('admin.category.show', $category->slug);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('admin.category.index');
    }
}
