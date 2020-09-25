@extends('templates.master')

@section('content-view')
@if(session('sessionSuccess'))
    <h3> {{ session('sessionSuccess')['messages'] }} </h3>
@endif  

{!! Form::open(['route' => 'instituition.store', 'method' => 'post', 'class' => 'form-padrao']) !!}
    @include('templates.formulario.input', ['label' => 'Nome', 'input' => 'name', 'attributes' => ['placeholder' => 'Name']])
    @include('templates.formulario.submit', ['input' => 'Cadastrar'])
{!! Form::close() !!}

<table class="default-table">
    <thead>
        <tr>
            <td> Código </td>
            <td> Nome da Instituição </td>
            <td colspan="4"> Opções </td>
        </tr>
    </thead>
    <tbody>
        @foreach($instituitions as $inst)
            <tr>
                <td>{{ $inst->id }}</td>
                <td>{{ $inst->name }}</td>
                <td>
                    {!! Form::open(['route' => ['instituition.destroy', $inst->id], 'method' => 'DELETE']) !!} 
                    {!! Form::submit('Remover') !!}
                    {!! Form::close() !!}
                </td>                
                <td>
                    <a href="{{ route('instituition.show', $inst->id) }}"> Detalhes </a>
                </td>
                <td>
                    <a href="{{ route('instituition.edit', $inst->id) }}"> Editar </a>
                </td>
                <td>
                    <a href="{{ route('instituition.products.index', $inst->id) }}"> Produtos </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection