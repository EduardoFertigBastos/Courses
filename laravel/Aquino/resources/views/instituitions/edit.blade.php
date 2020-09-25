@extends('templates.master')

@section('css-view')
@endsection()

@section('js-view')
@endsection()

@section('content-view')

    @if(session('sessionSuccess'))
        <h3> {{ session('sessionSuccess')['messages'] }} </h3>
    @endif  

    {!! Form::model($instituition, ['route' => ['instituition.update', $instituition->id], 
        'method' => 'put', 'class' => 'form-padrao']) !!}
        
        @include('templates.formulario.input', 
        ['label' => 'Nome', 'input' => 'name', 'attributes' => ['placeholder' => 'Name']])
    
        @include('templates.formulario.submit', ['input' => 'Atualizar'])
    {!! Form::close() !!}


@endsection()

