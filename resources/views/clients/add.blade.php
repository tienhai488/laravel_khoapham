@extends('layouts/client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    <h1>Sidebar</h1>
@endsection

@section('content')
    <h1>Thêm sản phẩm</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            Vui lòng kiểm tra lại dữ liệu!
        </div>
    @endif
    <form method="post">
        @csrf
        <input type="hidden" name="_method" value="post">
        <div class="form-group">
            <label for="">Tên sản phẩm</label>
            <input spellcheck="false" type="text" class="form-control" name="product_name" placeholder="Tên sản phẩm..."
                value="{{ old('product_name') }}">
            @error('product_name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Giá sản phẩm</label>
            <input spellcheck="false" type="text" class="form-control" name="product_price" placeholder="Giá sản phẩm..."
                value="{{ old('product_price') }}">
            @error('product_price')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
@endsection
