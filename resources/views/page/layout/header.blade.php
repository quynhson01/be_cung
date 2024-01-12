<div class="header_area">
    <!--header top-->
    <div class="header_top">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="switcher">
                    <a style="font-size: 14px;"><i class="fa fa-clock-o" aria-hidden="true"></i> Từ 8h30 đến 22h00 từ Thứ 2 - Chủ Nhật</a>

                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="header_links">
                    <ul>
                        @if(Auth::check())
                        @if(Auth::user()->level == 1)
                        <li><a href="{{route('admin_index')}}">Quản trị</a></li>
                        <li><a title="Thông tin tài khoản" href="{{route('information')}}">Tài khoản: {{Auth::user()->full_name}}</a></li>
                        <li><a href="{{route('logout')}}">Đăng xuất</a></li>
                        @elseif(Auth::user()->level == 0)
                        <li><a title="Giỏ hàng" href="{{route('shopping_cart')}}">Giỏ hàng</a></li>
                        <li><a title="Thông tin tài khoản" href="{{route('information')}}">Tài khoản: {{Auth::user()->full_name}}</a></li>
                        <li><a href="{{route('logout')}}">Đăng xuất</a></li>
                        @endif
                        @else
                        <li><a href="{{route('register')}}">Đăng ký</a></li>
                        <li><a href="{{route('login')}}">Đăng nhập</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--header top end-->

    <!--header middel-->
    <div class="header_middel">
        <div class="row align-items-center" style="height: 120px;">
            <!--logo start-->
            <div class="col-lg-3 col-md-3">
                <div class="logo">
                    <a href="{{route('home')}}"><img src="assets\img\logo\logomw.png" width="180px;" alt=""></a>
                </div>
            </div>
            <!--logo end-->
            <div class="col-lg-9 col-md-9" style="padding-top: 50px;">
                <div class="header_right_info" >
                    <div class="search_bar">
                        <form action="{{route('search')}}">
                            <input placeholder="Tìm kiếm..." autocomplete="off" type="text" name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="shopping_cart">
                        <a href="{{route('shopping_cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng (@if(Session::has('cart'))<span id="total_qty_header">{{Session('cart')->totalQty}}</span>)
                            - <span id="total_price_header">{{number_format(Session('cart')->totalPrice)}}</span> đ
                            @else<span id="total_qty_header">0</span>)
                            - <span id="total_price_header">0</span> đ
                            @endif</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--header middel end-->
    <div class="header_bottom">
        <div class="row">
            <div class="col-12">
                <div class="main_menu_inner">
                    <div class="main_menu d-none d-lg-block">
                        <nav>
                            <ul>
                                <li class="active"><a href="{{route('home')}}">TRANG CHỦ</a></li>
                                @foreach($menus as $menu)
                                @if(count($menu->productType) > 0)
                                <li><a style="color: #FFF;">{{$menu->name}}</a>
                                    <div class="mega_menu jewelry">
                                        <div class="mega_items jewelry">
                                            <ul>
                                                @foreach($menu->productType as $type)
                                                @if(count($type->products) > 0)
                                                <li><a href="{{route('product_type',$type->id)}}">{{$type->name}}</a></li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                @endif
                                @endforeach

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
