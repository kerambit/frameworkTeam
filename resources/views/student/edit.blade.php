@extends('layouts.app')
@section('title', 'Профиль студента')

@section('content')
    @include('includes.errors')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <hr>
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-10"><h1>{{ $student->full_name }}</h1></div>
        </div>
        <div class="row">
            <div class="col-sm-3">


                <div class="text-center">
                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                    @if (!Auth::guest() and Auth::user()->id == $student->id)
                        <h6>Выберите фотографию профиля</h6>
                        {{--                        <input type="file" class="text-center center-block file-upload">--}}
                    @endif
                </div></hr><br>

                <ul class="list-group">
                    <li class="list-group-item text-muted">Основная информация</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Эл. почта</strong></span> {{ $student->email }}</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Группа</strong></span> {{ $student->group->name }}</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Средний балл учащегося</strong></span> {{ number_format($student->marks->avg('mark'), 2, ',', '') }}</li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Количество сданных предметов</strong></span> {{ count($student->marks) }}</li>
                </ul>

            </div>
            <div class="col-sm-9">
                @if (!Auth::guest() and Auth::user()->id == $student->id)
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <hr>
                            <form class="form" action="{{ route('users.update', $student->id) }}" method="post" id="registrationForm">
                                @csrf
                                @method('PUT')

                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="lastName"><h4>Фамилия</h4></label>
                                        <input type="text" class="form-control" name="last_name" id="lastName" placeholder="Введите фамилию" value="{{ $student->last_name }}">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="firstName"><h4>Имя</h4></label>
                                        <input type="text" class="form-control" name="first_name" id="firstName" placeholder="Введите имя" value="{{ $student->first_name }}">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="middleName"><h4>Отчество</h4></label>
                                        <input type="text" class="form-control" name="middle_name" id="middleName" placeholder="Введите отчество" value="{{ $student->middle_name }}">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="email"><h4>Email</h4></label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Введите ваш email" value="{{ $student->email }}">
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="inputGroupName"><h4>Группа</h4></label>
                                        <select id="inputGroupName" class="form-control form-control-sm" name="group_id">
                                            @foreach($groups as $group)
                                                @if ($group->id == $student->group->id)
                                                    <option value="{{ $group->id }}" selected>{{ $group->name }}</option>
                                                @else
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <br>
                                        <button class="btn btn-lg btn-success" type="submit">Сохранить изменения</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('users.destroy', $student->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <br>
                                        <button class="btn btn-danger" type="submit">Покинуть данный альма-матер</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @else
                            <h2>Настройки профиля недоступны для не вашего аккаунта!</h2>
                        @endif
                    </div>
            </div>
@endsection
