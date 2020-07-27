@extends('layouts.app')
@section('title', 'Редактирование группы')

@section('content')
    @include('includes.errors')

    <h2>Редактирование группы {{ $group->name }}</h2>
    @include('includes.forms.group', ['route' => route('groups.update', $group->id)])
@endsection
