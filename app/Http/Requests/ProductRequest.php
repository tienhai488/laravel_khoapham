<?php

namespace App\Http\Requests;

use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;


class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_name' => ['required', 'min:6'],
            'product_price' => 'required|integer',
        ];
    }

    public function messages()
    {
        // return [
        //     'product_name.required' => ":attribute không được để trống!",
        //     'product_name.min' => ":attribute có ít nhất :min ký tự!",
        //     'product_price.required' => ":attribute không được để trống!",
        //     'product_price.integer' => ":attribute không hợp lệ!",
        // ];

        return [
            'required' => ":attribute không được để trống!",
            'min' => ":attribute có ít nhất :min ký tự!",
            'integer' => ":attribute không hợp lệ!",
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count()>0) {
                $validator->errors()->add('msg', 'Vui lòng kiểm tra lại dữ liệu!');
            }
        });
    }

    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         'slug' => 'TienHaiSlug',
    //     ]);
    // }

}