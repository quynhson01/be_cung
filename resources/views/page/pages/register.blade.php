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
                                <li>Đăng ký</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumbs area end-->

            <!-- customer login start -->
            <div class="customer_login">
                <div class="row">

                    <!--register area start-->
                    <div class="col-lg-6 col-md-6" style="margin-left: 300px;">
                        <div class="account_form register">

                            <h2>Đăng ký</h2>
                            <form action="{{route('register')}}" method="post">
                                @csrf
                                <p>
                                    <label>Họ và tên <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                    <input type="text" name="fullname" placeholder="Họ và tên..." value="{{ old('fullname')}}">
                                    @error('fullname')
                                    <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                    @enderror
                                </p>
                                <p>
                                    <label>Email <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                    <input type="text" name="email" placeholder="Email..." value="{{ old('email')}}">
                                    @error('email')
                                    <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                    @enderror
                                </p>
                                <p>
                                    <label>Địa chỉ <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                    <input type="text" name="address" placeholder="Địa chỉ..." value="{{ old('address')}}">
                                    @error('address')
                                    <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                    @enderror
                                </p>
                                <p>
                                    <label>Số điện thoại <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                    <input type="text" name="phone" placeholder="Số điện thoại..." value="{{ old('phone')}}">
                                    @error('phone')
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
                                <p>
                                    <label>Nhập lại mật khẩu <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                    <input type="password" name="re_password" placeholder="******">
                                    @error('re_password')
                                    <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                    @enderror
                                </p>
                                <div class="login_submit">
                                    <button type="submit">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--register area end-->
                </div>
            </div>
            <!-- customer login end -->

        </div>
        <!--pos page inner end-->
    </div>
</div>
<!--pos page end-->
@endsection
