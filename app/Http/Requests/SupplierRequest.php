<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name'=>'required|unique:supplier',
            'img' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    public function messages(){
        return [
            'name.unique'=>'Tên thương hiệu đã tồn tại',
            'name.required'=>'Vui lòng nhập tên thương hiệu',
            'img.required'=>'Vui lòng chọn ảnh',
            'img.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
            'img.max' => 'Giới hạn hình ảnh dung lượng không quá 2M',   
        ];   
    }
}
