@extends('templates.master')

@section('content-view')

@if(session('sessionSuccess'))
        <h3> {{ session('sessionSuccess')['messages'] }} </h3>
@endif 

{!! Form::open(['route' => 'movement.storeGetBack', 'method' => 'post', 'class' => 'form-padrao']) !!}    

    @include('templates.formulario.select', ['label' => 'Grupo',
            'select' => 'group_id', 'data' => $groupList ?? [], 
            'attributes' => ['placeholder' => 'Grupo']])

    @include('templates.formulario.select', ['label' => 'Produto',
            'select' => 'products_id', 'data' => $productList ?? [], 
            'attributes' => ['placeholder' => 'Produto']])
    
    @include('templates.formulario.input', ['label' => 'Valor',
            'input' => 'value', 'attributes' => ['placeholder' => 'Valor']])

    @include('templates.formulario.submit', ['input' => 'Cadastrar'])
{!! Form::close() !!}


@endsection