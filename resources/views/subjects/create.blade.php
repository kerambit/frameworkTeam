@extends('layouts.app')
@section('title', 'Создание нового предмета')

@section('content')
    @include('includes.errors')

    <h2>Создание предмета</h2>
    @include('includes.forms.subject', ['route' => route('subjects.store')])
@endsection
