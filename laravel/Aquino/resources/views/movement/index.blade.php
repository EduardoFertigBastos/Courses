@extends('templates.master')

@section('content-view')

@if(session('sessionSuccess'))
    <h3> {{ session('sessionSuccess')['messages'] }} </h3>
@endif  

<table class="default-table">
    <thead>
        <tr>
            <td> Código </td>
            <td> Nome da Instituição </td>
            <td> Valor Investido</td>
        </tr>
    </thead>
    <tbody>
        @foreach($product_list as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->instituition->name }}</td>
                <td>{{ $product->valueFromUser(Auth::user()) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection