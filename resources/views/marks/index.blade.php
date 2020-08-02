@extends('layouts.app')
@section('title', 'Журнал оценок')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{ $students->links() }}

    <a class="btn btn-primary" href="{{ route('marks.create') }}">Внести оценки</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Имя студента</th>
                <th scope="col">Группа</th>
                @foreach($subjects as $subject)
                    <th scope="col">{{ $subject->name }}</th>
                    <th scope="col">Ср.б. по гр. по {{ $subject->name }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    @if ($marks->where('student_id', '=', $student->id)->avg('mark') == 5)
                        <td style="border: 1px solid green">{{ $student->name }}</td>
                    @elseif ($marks->where('student_id', '=', $student->id)->where('mark', '=', 3)->isEmpty())
                        <td style="border: 1px solid yellow">{{ $student->name }}</td>
                    @else
                        <td style="border: 1px solid red">{{ $student->name }}</td>
                    @endif
                    <td>{{ $student->group->name }}</td>
                    @foreach($student->marks as $mark)
                        <td><a href="{{ route('marks.show', $mark->id) }}">{{ $mark->mark }}<a></td>
                        <td>{{ number_format($marks->where('subject_id', '=', $mark->subject_id)
            ->where('group_id', '=', $student->group_id)->avg('mark'), 2, ',', '') }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>

    {{ $students->links() }}
@endsection
