@extends('page.layout.master')
@section('content')
<!--pos page start-->
<div class="pos_page">
    <div class="container">
        <!--pos page inner-->
        <div class="pos_page_inner">

            <!--breadcrumbs area start-->
            <div class="breadcrumbs_area">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb_content">
                            <ul>
                                <li><a href="{{route('home')}}">Trang chủ</a></li>
                                <li><i class="fa fa-angle-right"></i></li>
                                <li>Đăng nhập</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumbs area end-->

            <!-- customer login start -->
            <div class="customer_login">
                <div class="row">
                    <!--login area start-->
                    <div class="col-lg-6 col-md-6" style="margin-left: 300px;">
                        <div class="account_form">
                            @if(Session::has('success'))
                            <div style="font-size: 18px;" class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if(Session::has('error'))
                            <div style="font-size: 18px;" class="alert alert-danger">{{Session::get('error')}}.</div>
                            @endif
                            <h2>Đăng nhập</h2>
                            <form action="{{route('login')}}" method="post">
                                @csrf
                                <p>
                                    <label>Email <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                    <input type="text" name="email" placeholder="Email..." value="{{ old('email')}}">
                                    @error('email')
                                    <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                    @enderror
                                </p>
                                <p>
                                    <label>Mật khẩu <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                    <input type="password" name="password" placeholder="******">
                                    @error('password')
                                    <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                    @enderror
                                </p>
                                <div class="login_submit">
                                    <button type="submit">Đăng nhập</button>
                                    <a href="{{route('reset_password')}}" target="_blank">Quên mật khẩu ?</a>
                                </div>

                            </form>
                        </div>
                        <div class="row"><a style="font-size: 20px;margin-left: 15px;color: #018576;"></a><a href="{{route('register')}}" style="font-size: 16px;margin-left: 10px;margin-top: 2px;color: #00bba6;">Đăng ký ngay!</a></div>
                    </div>
                    <!--login area start-->
                </div>
            </div>
            <!-- customer login end -->

        </div>
        <!--pos page inner end-->
    </div>
</div>
<!--pos page end-->
@endsection
