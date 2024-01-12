<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleBannerEditRequest extends FormRequest
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
            'type'=> 'required',
            'img' => 'mimes:jpg,jpeg,png,gif|max:2048',   
        ];
    }

    public function messages(){
        return [
            'type.required'=>'Vui lòng chọn thuộc loại sản phẩm',
            'img.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
            'img.max' => 'Hình thẻ giới hạn dung lượng không quá 2M'
        ];   
    }
}
