<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function getResetPassword()
    {
        return view('page.reset_password.reset_password');
    }

    public function postResetPassword(Request $request)
    {
        $email = $request->email;
        $checkUser = User::where('email', $email)->first();

        if (!$checkUser) {
            return redirect()->back()->with('fail', 'Email không tồn tại');
        }
        $code = bcrypt(md5(time() . $email));
        $checkUser->code = $code;
        $checkUser->time_code = Carbon::now();
        $checkUser->save();

        $url = route('link_password_reset', ['code' => $code, 'email' => $email]);

        $data = [
            'route' => $url
        ];
        Mail::send('page.reset_password.view_password', $data, function ($message) use ($email) {
            $message->to($email, 'Reset password')->subject('Lấy lại mật khẩu!');
        });
        return redirect()->back()->with('success', 'Link lấy lại mật khẩu đã gửi vào email của bạn');
    }

    public function getPasswordReset(Request $request)
    {
        $code = $request->code;
        $email = $request->email;

        $checkUser = User::where([
            'code' => $code,
            'email' => $email
        ])->first();
        if (!$checkUser) {
            return redirect()->back()->with('danger', 'Đường dẫn lấy lại mật khẩu không đúng, vui lòng thử lại');
        }
        return view('page.reset_password.password_reset');
    }

    public function postPasswordReset(Request $request)
    {
        $this->validate(
            $request,
            [
                'password' => 'required|min:6|max:20',
                'repassword' => 'required|same:password',
            ],
            [
                'password.required' => 'Vui lòng nhập mật khẩu mới',
                'repassword.required' => 'Vui lòng nhập mật khẩu xác nhận',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự',
                'password.max' => 'Mật khẩu không quá 20 kí tự',
                'repassword.same' => 'Mật khẩu xác nhận không đúng'
            ]
        );

        $code = $request->code;
        $email = $request->email;

        $checkUser = User::where([
            'code' => $code,
            'email' => $email
        ])->first();
        if (!$checkUser) {
            return redirect()->back()->with('danger', 'Đường dẫn lấy lại mật khẩu không đúng, vui lòng thử lại');
        }

        $checkUser->password = bcrypt($request->password);
        $checkUser->save();
        return redirect()->route('login')->with('success', 'Mật khẩu đã được đổi thành công, mời bạn đăng nhập');
    }
}
