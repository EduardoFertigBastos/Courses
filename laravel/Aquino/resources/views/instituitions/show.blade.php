@extends('templates.master')

@section('content-view')

<header>
    <h1>{{ $instituition->name }}</h1>
</header>

@include('groups.list', ['group_list' => $instituition->groups])

@endsection