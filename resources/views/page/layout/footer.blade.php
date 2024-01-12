<div class="footer_area">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>BE CUNG</h3>
                        <div class="footer_widget_contect">
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> 108 Đường Yersin, Nguyễn Thái Bình, Quận 1, Thành phố Hồ Chí Minh</p>

                            <p><i class="fa fa-mobile" aria-hidden="true"></i> 0778588538 </p>
                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> phamthiquynhsonqbdl@gmail.com </a>
                            <ul>
                                <li>Thời gian làm việc: Thứ 2 - Chủ Nhât.</li>
                                <li>&nbsp; Sáng: 8h30h - 12h</li>
                                <li>&nbsp; Chiều: 13h - 22h</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>Danh mục sản phẩm</h3>
                        <ul>
                            @foreach($menu_f as $menu)
                            @if(count($menu->productType) > 0)
                            <li><a>{{$menu->name}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>Tài khoản</h3>
                        <ul>
                            <li><a href="{{route('information')}}">Thông tin</a></li>
                            <li><a href="{{route('change_password')}}">Đổi mật khẩu</a></li>
                            <li><a href="{{route('order')}}">Lịch sử đặt hàng</a></li>
                            <li><a href="{{route('register')}}">Đăng ký</a></li>
                            <li><a href="{{route('login')}}">Đăng nhập</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer_widget">
                        <h3>Địa điểm kinh doanh</h3>
                        <iframe style="width: 100%; height: 100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.571511628987!2d106.69488947443476!3d10.767469189380796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f157d82951d%3A0xdd85e32200aa3fc2!2zMTA4IMSQLiBZZXJzaW4sIFBoxrDhu51uZyBOZ3V54buFbiBUaMOhaSBCw6xuaCwgUXXhuq1uIDEsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1697293710385!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copyright_area">
                        <p>BE CUNG - KIDS FASHION</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer_social text-right">
                        <ul>
                            <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://accounts.google.com/"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
