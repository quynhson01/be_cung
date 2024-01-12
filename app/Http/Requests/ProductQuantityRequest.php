<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductQuantityRequest extends FormRequest
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
            'quantity'=>'required|min:1|max:99999999999|integer',
        ];
    }

    public function messages(){
        return [
            'quantity.required'=>'Vui lòng nhập số lượng',
            'quantity.integer'=>'Số lượng phải là dạng số',
            'quantity.min'=>'Số lượng ít nhất 1',
            'quantity.max'=>'Số lượng không được quá 99999999999',
        ];   
    }
}
