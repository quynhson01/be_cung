<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
            'size'=>'required|max:20',
        ];
    }

    public function messages(){
        return [
            'size.required'=>'Vui lòng nhập kích thước',
            'size.max'=>'kích thước không quá 20 ký tự',
        ];   
    }
}
