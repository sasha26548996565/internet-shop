@extends('admin.layouts.master')

@isset($propertyOption)
    @section('title', 'Редактировать вариант свойства ' . $propertyOption->name)
@else
    @section('title', 'Создать вариант свойства')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($propertyOption)
            <h1>Редактировать вариант свойства <b>{{ $propertyOption->name }}</b></h1>
        @else
            <h1>Добавить вариант свойства <b>{{ $property->name }}</b></h1>
        @endisset

        <form method="POST"
            @isset($propertyOption)
                action="{{ route('admin.propertyOption.update', [$property->slug, $propertyOption->slug]) }}"
            @else
                action="{{ route('admin.propertyOption.store', $property->slug) }}"
            @endisset>
            <div>
                @isset($propertyOption)
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
                            value="@isset($propertyOption) {{ $propertyOption->name }} @endisset">
                    </div>
                </div>
                <br>

                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
