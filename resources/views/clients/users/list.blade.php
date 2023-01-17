@extends('layouts/client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
    <h1>Users sidebar</h1>
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1>{{ $title }}</h1>
    <a href="{{ route('user.add') }}" class="btn btn-primary">Thêm người dùng</a>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Thời gian</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($userList))
                @foreach ($userList as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->create_at }}</td>
                        <td><a href="{{ route('user.get-edit', ['id' => $user->id]) }}" class="btn btn-sm btn-warning">Sửa</a>
                        </td>
                        <td><a href="{{ route('user.delete', ['id' => $user->id]) }}"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa!');" class="btn btn-sm btn-danger">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">
                        <h5>Chưa có người dùng nào!</h5>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
