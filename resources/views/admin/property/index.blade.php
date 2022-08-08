@extends('admin.layouts.master')

@section('title', 'Свойства')

@section('content')
    <div class="col-md-12">
        <h1>Свойства</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Название
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($properties as $property)
                <tr>
                    <td>{{ $property->id }}</td>
                    <td>{{ $property->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('admin.property.destroy', $property->slug) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('admin.property.show', $property->slug) }}"
                                    >Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('admin.property.edit', $property->slug) }}"
                                    >Редактировать</a>
                                <a class="btn btn-primary" type="button" href="{{ route('admin.propertyOption.index', $property->slug) }}"
                                        >Варианты свойств</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить">
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-success" type="button"
           href="{{ route('admin.property.create') }}">Добавить свойство</a>
    </div>

    <br>{{ $properties->withQueryString()->links() }}
@endsection
