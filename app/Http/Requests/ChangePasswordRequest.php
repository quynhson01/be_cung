<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'oldpassword' => 'required|min:6|max:20',
            'password' => 'required|min:6|max:20',
            'repassword' => 'required|same:password|min:6|max:20',
        ];
    }

    public function messages()
    {
        return [
            'oldpassword.required' => 'Vui lòng nhập mật khẩu cũ',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'repassword.required' => 'Vui lòng nhập lại mật khẩu mới',
            'oldpassword.min' => 'Mật khẩu ít nhất 6 kí tự',
            'oldpassword.max' => 'Mật khẩu không quá 20 kí tự',
            'password.min' => 'Mật khẩu ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu không quá 20 kí tự',
            'repassword.min' => 'Mật khẩu ít nhất 6 kí tự',
            'repassword.max' => 'Mật khẩu không quá 20 kí tự',
            'repassword.same' => 'Mật khẩu không khớp'
        ];
    }
}
