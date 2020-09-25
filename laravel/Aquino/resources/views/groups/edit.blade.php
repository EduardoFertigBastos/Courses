@extends('templates.master')

@section('content-view')
@if(session('sessionSuccess'))
    <h3> {{ session('sessionSuccess')['messages'] }} </h3>
@endif  

{!! Form::model($group, ['route' => ['group.update', $group->id],
                'method' => 'put', 'class' => 'form-padrao']) !!}
    @include('templates.formulario.input', ['label' => 'Nome do Grupo',
            'input' => 'name', 'attributes' => ['placeholder' => 'Nome do Grupo']])

    @include('templates.formulario.select', ['label' => 'User',
            'select' => 'user_id', 'data' => $aUserList, 'attributes' => ['placeholder' => 'User']])

    @include('templates.formulario.select', ['label' => 'Instituition',
            'select' => 'instituition_id', 'data' => $aInstituitionList, 'attributes' => ['placeholder' => 'Instituition']])
    
    @include('templates.formulario.submit', ['input' => 'Atualizar'])
{!! Form::close() !!}

@endsection