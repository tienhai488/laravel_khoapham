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
    <form action="" class="mb-3" method="get">
        <div class="row">
            <div class="col-3">
                <select class="form-control" name="status" id="">
                    <option value="0">Chọn trạng thái</option>
                    <option {{ request()->status == 'kichhoat' ? 'selected' : false }} value="kichhoat">Kích hoạt</option>
                    <option {{ request()->status == 'chuakichhoat' ? 'selected' : false }} value="chuakichhoat">Chưa kích
                        hoạt</option>
                </select>
            </div>
            <div class="col-3">
                <select class="form-control" name="group_id" id="">
                    <option value="0">Chọn nhóm</option>
                    @if (!empty(getAllGroups()))
                        @foreach (getAllGroups() as $item)
                            <option {{ request()->group_id == $item->id ? 'selected' : false }} value="{{ $item->id }}">
                                {{ $item->fullname }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-4">
                <input name="keyword" class="form-control" type="search" placeholder="Từ khóa tìm kiếm..."
                    value="{{ request()->keyword }}">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th><a href="?sortBy=fullname&sortType={{ $sortBy == 'fullname' ? $sortType : $sortTypeOld }}">Tên</a>
                </th>
                <th><a href="?sortBy=email&sortType={{ $sortBy == 'email' ? $sortType : $sortTypeOld }}">Email</a></th>
                <th>Nhóm</th>
                <th>Trạng thái</th>
                <th><a href="?sortBy=create_at&sortType={{ $sortBy == 'create_at' ? $sortType : $sortTypeOld }}">Thời
                        gian</a></th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty(json_decode(json_encode($userList), true)))
                @foreach ($userList as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->name_group }}</td>
                        <td>{!! $user->status == 1
                            ? '<button class="btn btn-sm btn-primary">Kích hoạt</button>'
                            : '<button class="btn btn-sm btn-warning">Chưa kích hoạt</button>' !!}</td>
                        <td>{{ $user->create_at }}</td>
                        <td><a href="{{ route('user.get-edit', ['id' => $user->id]) }}"
                                class="btn btn-sm btn-warning">Sửa</a>
                        </td>
                        <td><a href="{{ route('user.delete', ['id' => $user->id]) }}"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa!');"
                                class="btn btn-sm btn-danger">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8">
                        <h5>Không có người dùng nào!</h5>
                    </td>
                </tr>
            @endif


        </tbody>
    </table>

    <div class="pagination-container d-flex justify-content-end">
        {{ $userList->links() }}
    </div>
@endsection
