@extends('layouts.app')
@section('title', 'Список предметов в семестре')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('subjects.index') }}" class="form-group">
        <div class="form-group">
            <label for="filterSubjectName" class="form-control">Фильтрация по названию предмета</label>
            <input type="text" id="filterSubjectName" name="name" value="{{ request()->name ?? '' }}" class="form-control">
        </div>
        <button class="btn btn-primary" type="submit">Фильтровать</button>
    </form>

    <a class="btn btn-primary" href="{{ route('subjects.create') }}">Создать новый предмет</a>

    <ul class="list-group">
    @foreach($subjects as $subject)
        <li class="list-group-item"><a href="{{ route('subjects.show', $subject->id) }}">{{ $subject->name }}</a></li>
    @endforeach
    </ul>
@endsection
