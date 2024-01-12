<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'type'=>'required',
            'supplier'=>'required',
            'img' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'description'=>'required',
            'original' =>'required|min:1|max:5000000|integer|lt:price',
            'price' =>'required|min:1|max:5000000|integer',
            'promotion' =>'required|min:0|max:5000000|integer|lt:price',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Vui lòng nhập tên sản phẩm',
            'type.required'=>'Vui lòng Chọn loại sản phẩm',
            'supplier.required'=>'Vui lòng chọn thương hiệu',
            'img.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
            'img.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
            'description.required'=>'Vui lòng nhập mô tả ngắn sản phẩm',
            'original.required'=>'Vui lòng nhập giá nhập',
            'original.integer'=>'Giá nhập phải là dạng số',
            'original.min'=>'Giá nhập phải trong khoảng từ 1 đồng cho đến 5 triệu đồng',
            'original.max'=>'Giá nhập phải trong khoảng từ 1 đồng cho đến 5 triệu đồng',
            'price.required'=>'Vui lòng nhập giá bán',
            'price.integer'=>'Giá bán phải là dạng số',
            'price.min'=>'Giá bán phải trong khoảng từ 1 đồng cho đến 5 triệu đồng',
            'price.max'=>'Giá bán phải trong khoảng từ 1 đồng cho đến 5 triệu đồng',
            'promotion.required'=>'Vui lòng nhập giá khuyến mãi',
            'promotion.integer'=>'Giá khuyến mãi phải là dạng số',
            'promotion.min'=>'Giá khuyến mãi phải trong khoảng từ 0 đồng cho đến 5 triệu đồng',
            'promotion.max'=>'Giá khuyến mãi phải trong khoảng từ 0 đồng cho đến 5 triệu đồng',
            'original.lt'=>'Giá nhập phải thấp hơn giá bán',
            'promotion.lt'=>'Giá khuyến mãi phải thấp hơn giá bán',
        ];
    }
}
