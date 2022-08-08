@extends('admin.layouts.master')

@isset($product)
    @section('title', 'Редактировать товар ' . $product->name)
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($product)
            <h1>Редактировать товар <b>{{ $product->name }}</b></h1>
        @else
            <h1>Добавить товар</h1>
        @endisset
        <form method="POST" enctype="multipart/form-data"
              @isset($product)
              action="{{ route('admin.product.update', $product->slug) }}"
              @else
              action="{{ route('admin.product.store') }}"
            @endisset
        >
            <div>
                @isset($product)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                    <div class="col-sm-6">
                        @include('includes.error', ['fieldName' => 'price'])
                        <input type="number" class="form-control" name="price" id="price"
                               value="@isset($product){{ $product->price }}@endisset">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('includes.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name"
                               value="@isset($product){{ $product->name }}@endisset">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @include('includes.error', ['fieldName' => 'description'])
                        <textarea name="description" id="description" cols="72" class="form-control"
                                  rows="7">@isset($product){{ $product->description }}@endisset</textarea>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                    <div class="col-sm-6">
                        @include('includes.error', ['fieldName' => 'category_id'])
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(isset($product) && $product->category_id == $category->id)
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>

                <div class="input-group row">
                    <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label class="btn btn-default btn-file">
                            Загрузить <input type="file" style="display: none;" name="image" id="image">
                        </label>
                    </div>
                </div>
                <br>

                <div class="input-group row">
                    <label for="property_id" class="col-sm-2 col-form-label">свойства товара: </label>
                    <div class="col-sm-6">
                        @include('includes.error', ['fieldName' => 'property_ids'])
                        <select name="property_ids[]" id="property_id" multiple class="form-control" style="min-height: 70px;">
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}"
                                    @selected(isset($product) && $product->properties->contains($property->id))
                                >{{ $property->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @isset($product)
                    @foreach ($product->properties as $property)
                        <div class="input-group row">
                            <label for="property_option_ids[{{ $property->id }}]" class="col-sm-2 col-form-label">{{ $property->name }}: </label>
                            <div class="col-sm-6">
                                @include('includes.error', ['fieldName' => 'property_option_ids'])
                                <select name="property_option_ids[{{ $property->id }}]" id="property_option_ids" class="form-control">
                                    <option disabled selected>change</option>
                                    @foreach($property->propertyOptions as $propertyOption)
                                        <option value="{{ $propertyOption->id }}"
                                            @selected(isset($product) && $product->propertyOptions->contains($propertyOption->id))
                                        >{{ $propertyOption->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                    @endforeach
                @endisset
                <br>
                <div class="form-group row">
                    <label for="new" class="col-sm-2 col-form-label">NEW: </label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="new" id="new"
                        @checked(isset($product) && $product->new)>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="on_sale" class="col-sm-2 col-form-label">ON SALE: </label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="on_sale" id="on_sale"
                        @checked(isset($product) && $product->on_sale)>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
