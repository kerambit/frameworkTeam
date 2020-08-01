@extends('layouts.app')
@section('title', 'Предмета')

@section('content')
    @include('includes.errors')

    <h2>Редактирование предмета {{ $subject->name }}</h2>
    @include('includes.forms.subject', ['route' => route('subjects.update', $subject->id)])
@endsection
