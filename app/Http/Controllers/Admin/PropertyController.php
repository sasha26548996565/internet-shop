<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\PropertyRequest;

class PropertyController extends Controller
{
    public function index(): View
    {
        $properties = Property::latest()->paginate(10);

        return view('admin.property.index', compact('properties'));
    }

    public function create(): View
    {
        return view('admin.property.form');
    }

    public function store(PropertyRequest $request): RedirectResponse
    {
        $property = Property::create($request->validated());

        return to_route('admin.property.show', $property->slug);
    }

    public function show(string $propertySlug): View
    {
        $property = Property::where('slug', $propertySlug)->first();

        return view('admin.property.show', compact('property'));
    }

    public function edit(string $propertySlug): View
    {
        $property = Property::where('slug', $propertySlug)->first();

        return view('admin.property.form', compact('property'));
    }

    public function update(PropertyRequest $request, string $propertySlug): RedirectResponse
    {
        $property = Property::where('slug', $propertySlug)->first();
        $property->update($request->validated());

        return to_route('admin.property.show', $property->slug);
    }

    public function destroy(string $propertySlug): RedirectResponse
    {
        $property = Property::where('slug', $propertySlug)->first();
        $property->delete();

        return to_route('admin.property.index');
    }
}
