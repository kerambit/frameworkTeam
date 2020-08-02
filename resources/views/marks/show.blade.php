@extends('layouts.app')
@section('title', 'Оценка')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <h5 class="card-header">Студент: {{ $mark->student->name }}</h5>
        <div class="card-body">
            <h5 class="card-title">Предмет: {{ $mark->subject->name }}</h5>
            <p class="card-text">{{ $mark->mark }}</p>
            <a href="{{ route('marks.edit', $mark->id) }}" class="btn btn-primary">Изменить оценку</a>
            <form action="{{ route('marks.destroy', $mark->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Убрать оценку
                </button>
            </form>
        </div>
    </div>
@endsection
