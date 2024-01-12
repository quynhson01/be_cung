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
                                <li>Đổi mật khẩu</li>
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
                                        @if(Session::has('flag'))
                                        <div style="font-size: 18px;" class="alert alert-{{Session::get('flag')}}">{{Session::get('message')}}</div>
                                        @endif
                                        <center>
                                            <h3>Thông tin</h3>
                                        </center>
                                        <div class="login">
                                            <div class="login_form_container">
                                                <div class="account_login_form">
                                                    <form action="{{route('change_password')}}" method="post">
                                                        @csrf
                                                        <div class="form-group" style="position: relative;">
                                                            <label>Mật khẩu cũ <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                                            <input type="password" name="oldpassword" class="form-control" placeholder="******">
                                                            <a style="position: absolute;top: 58%;right: 10px;color: #007bff;font-size: 18px;" class="fa fa-eye"></a>
                                                            @error('oldpassword')
                                                            <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group" style="position: relative;">
                                                            <label>Mật khẩu mới <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                                            <input type="password" name="password" class="form-control" placeholder="******">
                                                            <a style="position: absolute;top: 58%;right: 10px;color: #007bff;font-size: 18px;" class="fa fa-eye"></a>
                                                            @error('password')
                                                            <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group" style="position: relative;">
                                                            <label>Nhập lại mật khẩu mới <span style="color: #FF0000; font-size: 18px;">*</span></label>
                                                            <input type="password" name="repassword" class="form-control" placeholder="******">
                                                            <a style="position: absolute;top: 58%;right: 10px;color: #007bff;font-size: 18px;" class="fa fa-eye"></a>
                                                            @error('repassword')
                                                            <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                                            @enderror
                                                        </div>
                                                        <div class="login_submit">
                                                            <button type="submit">Đổi mật khẩu</button>
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
    $(function() {
        $(".form-group a").click(function() {
            let $this = $(this);
            if ($this.hasClass('active')) {
                $this.parents('.form-group').find('input').attr('type', 'password')
                $this.removeClass('active');
            } else {
                $this.parents('.form-group').find('input').attr('type', 'text')
                $this.addClass('active')
            }
        });
    });
</script>
@stop