@extends('layouts/client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
    <h1>Home sidebar</h1>
@endsection

@section('content')
    <h1>Welcome!</h1>
    @include('clients.contents.slide')
    @include('clients.contents.about')

    <x-alert-component type='warning' message='Dang ky thanh cong!' />
@endsection
