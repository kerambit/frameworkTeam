@extends('layouts.app')
@section('title', 'Список групп')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{ $groups->links() }}

    <a class="btn btn-primary" href="{{ route('groups.create') }}">Создать новую группу</a>

    @foreach($groups as $group)
        <h2><a href="{{ route('groups.show', $group->id) }}">{{ $group->name }}</a></h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Номер</th>
                <th scope="col">Имя</th>
                <th scope="col">Дата рождения</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($group->students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->birth_date }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach

    {{ $groups->links() }}
@endsection
