@extends('layouts.app')
@section('title', 'Список предметов в семестре')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <a class="btn btn-primary" href="{{ route('subjects.create') }}">Создать новый предмет</a>

    <ul class="list-group">
    @foreach($subjects as $subject)
        <li class="list-group-item"><a href="{{ route('subjects.show', $subject->id) }}">{{ $subject->name }}</a></li>
    @endforeach
    </ul>
@endsection
