@extends('admin.layouts.master')

@section('content')
    <h1><a href="{{ route('admin.user.create') }}">create user</a></h1>

    @foreach ($users as $user)
        <div class="card mt-3">

        <div class="card-header">

            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <input type="submit" class="btn btn-danger" value="delete">
            </form>

            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">{{ $user->email }}</p>
            </div>
        </div>
    @endforeach

    {{ $users->withQueryString()->links() }}
@endsection
