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
                                <li>lấy lại mật khẩu</li>
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
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="account_form">
                            @if(Session::has('success'))
                            <div style="font-size: 18px;" class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if(Session::has('fail'))
                            <div style="font-size: 18px;" class="alert alert-danger">{{Session::get('fail')}}.</div>
                            @endif
                            <h2>Lấy lại mật khẩu</h2>
                            <form method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Vui lòng nhập địa chỉ email để lấy lại mật khẩu<span style="color: #FF0000; font-size: 18px;">*</span></label>
                                    <input type="text" name="email" class="form-control" placeholder="Email...">
                                    @error('email')
                                    <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                    @enderror
                                </div>
                                <div class="login_submit">
                                    <button type="submit">Xác nhận</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
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
