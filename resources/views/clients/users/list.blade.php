@extends('layouts/client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
    <h1>Users sidebar</h1>
@endsection

@section('content')
    <h1>{{ $title }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Thời gian</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($users))
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">Chưa có người dùng nào!</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
