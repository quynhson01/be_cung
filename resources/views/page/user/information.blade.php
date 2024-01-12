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
                                <li>Thông tin tài khoản</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumbs area end-->

            <!-- Start Maincontent  -->
            <section class="main_content_area">
                <div class="account_dashboard">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <!-- Nav tabs -->
                            @include('page.user.category')
                        </div>
                        <div class="col-sm-12 col-md-9 col-lg-9">
                            <div class="col-lg-9 col-md-9" style="margin-left: 100px;">
                                <!-- Tab panes -->
                                <div class="tab-content dashboard_content">
                                    <div class="tab-pane fade show active" id="dashboard">
                                        @if(Session::has('success'))
                                        <div style="font-size: 18px;" class="alert alert-success">{{Session::get('success')}}.</div>
                                        @endif
                                        <center>
                                            <h3>Thông tin</h3>
                                        </center>
                                        <div class="login">
                                            <div class="login_form_container">
                                                <div class="account_login_form">
                                                    <form action="{{route('information')}}" method="post">
                                                        @csrf
                                                        <span class="custom_checkbox">
                                                            <input type="checkbox" id="changeemail" name="changeemail">
                                                            <label>Thay đổi email <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                                        </span>
                                                        <input type="text" name="email" placeholder="Email..." class="form-control email" value="{{$user->email}}" disabled required>
                                                        @error('email')
                                                        <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                                        @enderror
                                                        <label>Họ và tên <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                                        <input type="text" name="fullname" placeholder="Họ và tên..." value="{{$user->full_name}}">
                                                        @error('fullname')
                                                        <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                                        @enderror
                                                        <br>
                                                        <label>Địa chỉ <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                                        <input type="text" name="address" placeholder="Địa chỉ..." value="{{$user->address}}">
                                                        @error('address')
                                                        <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                                        @enderror
                                                        <br>
                                                        <label>Số điện thoại <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                                        <input type="text" name="phone" placeholder="Số điện thoại..." value="{{$user->phone}}">
                                                        @error('phone')
                                                        <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                                        @enderror
                                                        <br>
                                                        <div class="login_submit">
                                                            <button type="submit">Cập nhật</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Maincontent  -->
        </div>
        <!--pos page inner end-->
    </div>
</div>
<!--pos page end-->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#changeemail').change(function() {
            if ($(this).is(":checked")) {
                $(".email").removeAttr('disabled');
            } else {
                $(".email").attr('disabled', '');
            }
        });
    });
</script>
@stop