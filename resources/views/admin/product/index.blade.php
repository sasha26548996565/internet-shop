@extends('admin.layouts.master')

@section('title', 'товары')

@section('content')
    <div class="col-md-12">
        <h1>Товары</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Код
                </th>
                <th>
                    Название
                </th>
                <th>
                    Картинка
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>{{ $product->name }}</td>
                    <td><img src="{{ Storage::url($product->image) }}" height="150" alt="{{ $product->name }}"></td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('admin.product.destroy', $product->slug) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('admin.product.show', $product->slug) }}"
                                    >Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('admin.product.edit', $product->slug) }}"
                                    >Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-success" type="button"
           href="{{ route('admin.product.create') }}">Добавить товар</a>
    </div>

    <br>{{ $products->withQueryString()->links() }}
@endsection
