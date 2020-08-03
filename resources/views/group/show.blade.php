@extends('layouts.app')
@section('title')
    Подробные данные о группе {{ $group->name }}
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h2>{{ $group->name }}</h2>
    <h3>Количество учащихся: {{ count($group->students) }}</h3>
    <a class="btn btn-primary" href="{{ route('groups.edit', $group->id) }}">Редактировать группу</a>
    <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">
            <i class="fa fa-trash"></i> Удалить группу
        </button>
    </form>

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
@endsection
