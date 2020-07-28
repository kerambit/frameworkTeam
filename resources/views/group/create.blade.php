@extends('layouts.app')
@section('title', 'Создание новой группы')

@section('content')
    @include('includes.errors')

    <h2>Создание группы</h2>
    @include('includes.forms.group', ['route' => route('groups.store')])
@endsection
