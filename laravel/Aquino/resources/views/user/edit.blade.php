@extends('templates.master')

@section('css-view')
@endsection()

@section('js-view')
@endsection()

@section('content-view')

    @if(session('sessionSuccess'))
        <h3> {{ session('sessionSuccess')['messages'] }} </h3>
    @endif  

    {!! Form::model($user, ['route' => ['user.update', $user->id], 
        'method' => 'put', 'class' => 'form-padrao']) !!}
        
        @include('user.form-fields')
        @include('templates.formulario.submit', ['input' => 'Atualizar'])
    {!! Form::close() !!}


@endsection()

