@extends('templates.master')

@section('content-view')
    
<header>
    <h1>{{ $group->name }}</h1>
    <h2>{{ $group->instituition->name }}</h2>
    <h2>{{ $group->user->name }}</h2>
</header>

{!! Form::open(['route' => ['group.user.store', $group->id],'method' => 'post', 'class' => 'form-padrao']) !!}
    @include('templates.formulario.select', [
        'label'         => 'Usuário',
        'select'        => 'user_id',
        'data'          => $user_list,
        'attributes'    => ['placeholder' => 'Usuário']
    ])

    @include('templates.formulario.submit', ['input' => 'Relacionar ao Grupo: ' . $group->id])
{!! Form::close() !!}

@include('user.list', ['user_list' => $group->users])

@endsection