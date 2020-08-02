@extends('layouts.app')
@section('title', 'Внести оценки')

@section('content')
    @include('includes.errors')

    <h2>Внесение оценок по предметам</h2>

    <form action="{{ route('marks.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="inputGroupName">Выберите предмет</label>
            <select id="inputSubjectName" class="form-control form-control-sm" name="subject_id">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>

            <label for="inputStudentName">Выберите Студента</label>
            <select id="inputStudentName" class="form-control form-control-sm" name="student_id">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" data-group="{{ $student->group->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
            <input type="hidden" id="inputGroupName" value="" name="group_id"/>

            <label for="inputMark">Выберите оценку</label>
            <select id="inputMark" class="form-control form-control-sm" name="mark">
                <option value="3">Оценка 3</option>
                <option value="4">Оценка 4</option>
                <option value="5">Оценка 5</option>
            </select>

        </div>
        <button type="submit" class="btn btn-primary">Внести оценку</button>
    </form>
@endsection
@push('scripts')
    <script>
        window.addEventListener('load', function() {
            $('#inputStudentName').on('change', function() {
                const group = $(':selected', this).data('group');
                $('#inputGroupName').val(group);
            })
        })
    </script>
@endpush

