@extends('layouts.app')
@section('title', 'Список групп')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('groups.index') }}" class="form-group">
        <div class="form-group">
            <label for="filterGroupName" class="form-control">Фильтрация по названию группы</label>
            <input type="text" id="filterGroupName" name="name" value="{{ request()->name ?? '' }}" class="form-control">
        </div>
        <button class="btn btn-primary" type="submit">Фильтровать</button>
    </form>

    {{ $groups->links() }}

    <a class="btn btn-primary" href="{{ route('groups.create') }}">Создать новую группу</a>

    @foreach($groups as $group)
        <h2><a href="{{ route('groups.show', $group->id) }}">{{ $group->name }}</a></h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Номер</th>
                <th scope="col">ФИО</th>
                <th scope="col">Дата рождения</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($group->students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->birth_date }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach

    {{ $groups->links() }}
@endsection
