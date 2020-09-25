@extends('templates.master')

@section('css-view')
@endsection()

@section('js-view')
@endsection()

@section('content-view')

    @if(session('sessionSuccess'))
        <h3> {{ session('sessionSuccess')['messages'] }} </h3>
    @endif  

    {!! Form::open(['route' => 'user.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
        @include('user.form-fields')
        @include('templates.formulario.submit', ['input' => 'Cadastrar'])
    {!! Form::close() !!}

    @include('user.list', ['user_list' => $users])


@endsection()

