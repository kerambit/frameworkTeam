@extends('layouts.app')
@section('title', 'Список студентов')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('users.index') }}" class="form-group">
        <div class="form-group">
            <label for="filterLastName" class="form-control">Фильтр по фамилии</label>
            <input type="text" id="filterLastName" name="last_name" value="{{ request()->last_name ?? '' }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="filterFirstName" class="form-control">Фильтр по имени</label>
            <input type="text" id="filterFirstName" name="first_name" value="{{ request()->first_name ?? '' }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="filterMiddleName" class="form-control">Фильтр по отчеству</label>
            <input type="text" id="filterMiddleName" name="middle_name" value="{{ request()->middle_name ?? '' }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="inputBirthDate">Фильтр по дате рождения</label>
            <select id="inputBirthDate" class="form-control form-control-sm" name="birth_date">
                @if (request()->birth_date == 'desc')
                    <option value="desc" selected>По возрастанию</option>
                    <option value="asc">По убыванию</option>
                @else
                    <option value="desc">По возрастанию</option>
                    <option value="asc" selected>По убыванию</option>
                @endif
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Фильтровать</button>
    </form>

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
