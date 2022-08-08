@extends('admin.layouts.master')

@section('title', 'Варианты свойств')

@section('content')
    <div class="col-md-12">
        <h1>Варианты свойств</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Свойсвто
                </th>
                <th>
                    Название
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($propertyOptions as $propertyOption)
                <tr>
                    <td>{{ $propertyOption->id }}</td>
                    <td>{{ $propertyOption->property->name }}</td>
                    <td>{{ $propertyOption->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('admin.propertyOption.destroy', [$property->slug, $propertyOption->slug]) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('admin.propertyOption.show', [$property->slug,
                                    $propertyOption->slug]) }}"
                                    >Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('admin.propertyOption.edit', [$property->slug,
                                    $propertyOption->slug]) }}"
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
           href="{{ route('admin.propertyOption.create', [$property->slug]) }}">Добавить Вариант свойства</a>
    </div>

    {{ $propertyOptions->withQueryString()->links() }}
@endsection
