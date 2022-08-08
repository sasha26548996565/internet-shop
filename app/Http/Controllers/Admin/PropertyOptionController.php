<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PropertyOption;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyOptionRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PropertyOptionController extends Controller
{
    public function index(string $propertySlug): View
    {
        $property = Property::where('slug', $propertySlug)->first();
        $propertyOptions = PropertyOption::where('property_id', $property->id)->latest()->paginate(10);

        return view('admin.property_option.index', compact('propertyOptions', 'property'));
    }

    public function create(string $propertySlug): View
    {
        $property = Property::where('slug', $propertySlug)->first();

        return view('admin.property_option.form', compact('property'));
    }

    public function store(PropertyOptionRequest $request, string $propertySlug): RedirectResponse
    {
        $property = Property::where('slug', $propertySlug)->first();

        $params = $request->validated();
        $params['property_id'] = $property->id;

        $propertyOption = PropertyOption::create($params);

        return to_route('admin.propertyOption.show', [$property->slug, $propertyOption->slug]);
    }

    public function show(string $propertySlug, string $propertyOptionSlug): View
    {
        $propertyOption = PropertyOption::where('slug', $propertyOptionSlug)->first();

        return view('admin.property_option.show', compact('propertyOption'));
    }

    public function edit(string $propertySlug, string $propertyOptionSlug): View
    {
        $property = Property::where('slug', $propertySlug)->first();
        $propertyOption = PropertyOption::where('slug', $propertyOptionSlug)->first();

        return view('admin.property_option.form', compact('property', 'propertyOption'));
    }

    public function update(PropertyOptionRequest $request, string $propertySlug, string $propertyOptionSlug): RedirectResponse
    {
        $property = Property::where('slug', $propertySlug)->first();
        $propertyOption = PropertyOption::where('slug', $propertyOptionSlug)->first();

        $propertyOption->update($request->validated());

        return to_route('admin.propertyOption.show', [$property->slug, $propertyOption->slug]);
    }

    public function destroy(string $propertySlug, string $propertyOptionSlug): RedirectResponse
    {
        $property = Property::where('slug', $propertySlug)->first();
        $propertyOption = PropertyOption::where('slug', $propertyOptionSlug)->first();

        $propertyOption->delete();

        return to_route('admin.propertyOption.index', $property->slug);
    }
}
