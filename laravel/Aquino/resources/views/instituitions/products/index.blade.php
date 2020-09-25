@extends('templates.master')

@section('content-view')
    
{!! Form::open(['route' => ['instituition.products.store', $instituition->id],
     'method' => 'post', 'class' => 'form-padrao']) !!}

    @include('templates.formulario.input', [
        'label' => 'Nome do Produto',
        'input' => 'name',
    ])

    @include('templates.formulario.input', [
        'label' => 'Descrição',
        'input' => 'description',
    ])

    @include('templates.formulario.input', [
        'label' => 'Indexador',
        'input' => 'index',
    ])

    @include('templates.formulario.input', [
        'label' => 'Taxa de Juros',
        'input' => 'interest_rate',
    ])

    @include('templates.formulario.submit', [
        'input' => 'Cadastrar'
    ])

{!! Form::close() !!}

    <table class="default-table">
        <thead>
            <tr>
                <th> # </th>
                <th> Nome </th>
                <th> Descrição </th>
                <th> Indexador </th>
                <th> Taxa </th>
                <th> Opções </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($instituition->products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->index }}</td>
                    <td>{{ $product->interest_rate }}</td>
                    <td>
                        {!! Form::open(
                            ['route' => [
                                    'instituition.products.destroy',
                                    $instituition->id,
                                    $product->id
                            ],
                            'method' => 'DELETE']) !!} 
                            {!! Form::submit('Remover') !!}
                        {!! Form::close() !!}
                    </td>                
                    <td>
                        <a href="{{ route('instituition.edit', $instituition->id) }}"> Editar </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td> Nada Cadastrado </td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection