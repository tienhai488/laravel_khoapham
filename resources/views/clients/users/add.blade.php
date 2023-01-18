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

    @if ($errors->any())
        <div class="alert alert-danger">Dữ liệu không hợp lệ! Vui lòng kiểm tra lại!</div>
    @endif

    <h1>{{ $title }}</h1>

    <form action="{{ route('user.post-add') }}" method="post">
        @csrf
        <div class="form-group mb-4">
            <label for="">Họ tên</label>
            <input name="fullname" type="text" class="form-control" placeholder="Họ tên..." value="{{ old('fullname') }}">
            @error('fullname')
                <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="">Email</label>
            <input name="email" type="text" class="form-control" placeholder="Email..." value="{{ old('email') }}">
            @error('email')
                <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <select class="form-control" name="group_id" id="">
                <option value="0">Chọn nhóm</option>
                @if (!empty(getAllGroups()))
                    @foreach (getAllGroups() as $item)
                        <option {{ request()->group_id == $item->id ? 'selected' : false }} value="{{ $item->id }}">
                            {{ $item->fullname }}</option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
                <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <select name="status" id="" class="form-control">
                <option value="0">Chưa kích hoạt</option>
                <option value="1">Kích hoạt</option>
            </select>
            @error('status')
                <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm người dùng</button>
        <a href="{{ route('user.index') }}" class="btn btn-warning">Quay lại</a>
    </form>
@endsection
