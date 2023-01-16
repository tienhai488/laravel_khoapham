@extends('layouts/client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    <h1>Sidebar</h1>
@endsection

@section('content')
    <h1>Thêm sản phẩm</h1>
    <div class="alert alert-danger msg" style="display: none">
    </div>
    <form method="post" id="product-form" action="{{ route('handleAddProduct') }}">
        @csrf
        <input type="hidden" name="_method" value="post">
        <div class="form-group">
            <label for="">Tên sản phẩm</label>
            <input spellcheck="false" type="text" class="form-control" name="product_name" placeholder="Tên sản phẩm..."
                value="{{ old('product_name') }}">
            <span style="color: red" class="error product_name_error"></span>

        </div>
        <div class="form-group">
            <label for="">Giá sản phẩm</label>
            <input spellcheck="false" type="text" class="form-control" name="product_price" placeholder="Giá sản phẩm..."
                value="{{ old('product_price') }}">
            <span style="color: red" class="error product_price_error"></span>

        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
@endsection

@section('js')
    <script>
        // const $ = document.querySelector.bind(document);
        // const $$ = document.querySelectorAll.bind(document);

        $(document).ready(() => {
            $('#product-form').on('submit', (e) => {
                e.preventDefault();

                let productName = $('input[name="product_name"]').val().trim();
                let productPrice = $('input[name="product_price"]').val().trim();

                let actionUrl = $('#product-form').attr('action');
                let csrfToken = $('input[name="_token"]').val().trim();

                $('.error').text('');

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: {
                        product_name: productName,
                        product_price: productPrice,
                        _token: csrfToken,
                    },
                    dataType: "json",
                    success: (response) => {
                        console.log(response);
                    },
                    error: (error) => {
                        $('.msg').show();
                        let responseJSON = error.responseJSON.errors;

                        console.log(responseJSON);
                        if (Object.keys(responseJSON).length > 0) {
                            $('.msg').text(responseJSON.msg);
                            for (let key in responseJSON) {
                                $(`.${key}_error`).text(responseJSON[key][0]);
                            }
                        }
                    }
                });
            })
        })
    </script>
@endsection
