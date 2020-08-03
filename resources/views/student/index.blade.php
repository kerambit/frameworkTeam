@extends('layouts.app')
@section('title', 'Список студентов')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{ $students->links() }}

    <h2>Список всех студентов</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Номер</th>
            <th scope="col">ФИО</th>
            <th scope="col">Дата рождения</th>
            <th scope="col">Группа</th>
            <th scope="col">Средний балл по всем предметам</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td><a href="{{ route('users.show', $student->id) }}">{{ $student->full_name }}</a></td>
                <td>{{ $student->birth_date }}</td>
                <td>{{ $student->group->name }}</td>
                <td>{{ number_format($student->marks->avg('mark'), 2, ',', '') }}</td>
                <td>{{ $student->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $students->links() }}
@endsection
