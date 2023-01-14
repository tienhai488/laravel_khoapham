@extends('layouts/client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
    <h1>Product sidebar</h1>
@endsection

@section('content')
    <h1>Product</h1>
@endsection
