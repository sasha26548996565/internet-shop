@extends('admin.layouts.master')

@isset($category)
    @section('title', 'Редактировать категорию ' . $category->name)
@else
@section('title', 'Создать категорию')
@endisset

@section('content')
<div class="col-md-12">
    @isset($category)
        <h1>Редактировать Категорию <b>{{ $category->name }}</b></h1>
    @else
        <h1>Добавить Категорию</h1>
    @endisset

    <form method="POST" enctype="multipart/form-data"
        @isset($category) action="{{ route('admin.category.update', $category->id) }}"
                      @else
                      action="{{ route('admin.category.store') }}" @endisset>
        <div>
            @isset($category)
                @method('PUT')
            @endisset
            @csrf

            <div class="input-group row">
                <label for="name" class="col-sm-2 col-form-label">Название: </label>
                <div class="col-sm-6">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-control" name="name" id="name"
                        value="@isset($category) {{ $category->name }} @endisset">
                </div>
            </div>
            <br>

            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
@endsection
