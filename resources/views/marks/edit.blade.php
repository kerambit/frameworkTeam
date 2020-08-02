@extends('layouts.app')
@section('title', 'Редактирование оценки')

@section('content')
    @include('includes.errors')

    <h2>Редактирование оценки студента {{ $mark->student->name }} по предмету {{ $mark->subject->name }}</h2>
    <h3>Текущая оценка: {{ $mark->mark }}</h3>

    <form action="{{ route('marks.update', $mark->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="inputGroupName">Предмет</label>
            <input type="number" id="inputSubjectName" name="subject_id" value="{{ $mark->subject->id }}" readonly>

            <label for="inputStudentName">Студент</label>
            <input type="number" id="inputStudentName" name="student_id" value="{{ $mark->student->id }}" readonly>
            <input type="hidden" id="inputGroupName" value="{{ $mark->student->group_id }}" name="group_id"/>

            <label for="inputMark">Выберите оценку</label>
            <select id="inputMark" class="form-control form-control-sm" name="mark">
                <option value="3">Оценка 3</option>
                <option value="4">Оценка 4</option>
                <option value="5">Оценка 5</option>
            </select>

        </div>
        <button type="submit" class="btn btn-primary">Изменить оценку</button>
    </form>
@endsection
