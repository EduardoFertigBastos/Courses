@extends('templates.master')

@section('content-view')

@if(session('sessionSuccess'))
    <h3> {{ session('sessionSuccess')['messages'] }} </h3>
@endif  

<table class="default-table">
    <thead>
        <tr>
            <td> Data </td>
            <td> Tipo </td>
            <td> Produto </td>
            <td> Grupo </td>
            <td> Valor </td>
            <td>  </td>
        </tr>
    </thead>
    <tbody>        
        @foreach($movement_list as $movement)
            <tr>
                <td>{{ $movement->created_at }}</td>
                <td>{{ $movement->type == 1 ? "Aplicação" : "Resgate" }}</td>
                <td>{{ $movement->products->name  }}</td>
                <td>{{ $movement->group->name }}</td>
                <td>{{ $movement->value }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection