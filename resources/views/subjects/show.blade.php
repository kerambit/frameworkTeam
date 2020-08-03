@extends('layouts.app')
@section('title')
    Подробные данные о предмете {{ $subject->name }}
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h2>{{ $subject->name }}</h2>
    <h3>Средний балл по предмету: {{ number_format($subject->marks->avg('mark'), 2, ',', '') }}</h3>
    <a class="btn btn-primary" href="{{ route('subjects.edit', $subject->id) }}">Редактировать предмет</a>
    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">
            <i class="fa fa-trash"></i> Удалить предмет
        </button>
    </form>

    {{ $paginator->links() }}

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Номер</th>
            <th scope="col">ФИО</th>
            <th scope="col">Оценка</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($paginator as $student)
            <tr>
                <td>{{ $student->student->id }}</td>
                <td>{{ $student->student->full_name }}</td>
                <td>{{ $student->mark }}</td>
                <td>{{ $student->student->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $paginator->links() }}

@endsection

