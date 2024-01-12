<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'fullname' => 'required|regex:/(^[\pL0-9 ]+$)/u|min:6|max:25',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|max:250',
            'phone' => 'required|numeric|digits:10',
            'password' => 'required|min:6|max:20',
            're_password' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Vui lòng nhập họ và tên',
            'fullname.regex' => 'Họ và tên không được có ký tự đặc biệt',
            'fullname.min' => 'Họ và tên Ít nhất 6 ký tự',
            'fullname.max' => 'Họ và tên Không vượt quá 25 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Emailkhông đúng định dạng',
            'email.unique' => 'Email đã có người sử dụng',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'address.max' => 'Địa chỉ không quá 250 ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 kí tự',
            'password.max' => 'Mật khẩu không quá 20 kí tự',
            're_password.required' => 'Vui lòng nhập lại mật khẩu',
            're_password.same' => 'Mật khẩu không khớp',
            'phone.required' => 'Vui lòng nhập số điện thoại',    
            'phone.digits' => 'Số điện thoại chỉ có 10 số',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số',
        ];
    }
}
