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
                                <li>Đặt hàng</li>
                            </ul>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumbs area end-->


            <!--Checkout page section-->
            <div class="Checkout_section">
                @if(Session::has('cart')>=1)
                <div class="checkout_form">
                    <form action="{{route('checkout')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <h3>Thông tin đặt hàng</h3>
                                <div class="col-lg-12 col-md-9">
                                    <div class="row">
                                        <div class="col-12 mb-30" style="margin-top: 20px;">
                                            <label>Họ và tên<span>*</span></label>
                                            <input type="text" name="fullname" value="{{$user->full_name}}">
                                            @error('fullname')
                                            <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-30">
                                            <label for="country">Giới tính <span>*</span></label>
                                            <select name="gender" id="country">
                                                <option value="1">Nam</option>
                                                <option value="2">Nữ</option>
                                            </select>
                                        </div>

                                        <div class="col-12 mb-30">
                                            <label>Email<span>*</span></label>
                                            <input type="email" name="email" value="{{$user->email}}">
                                            @error('email')
                                            <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-30">
                                            <label>Địa chỉ <span>*</span></label>
                                            <input type="text" name="address" value="{{$user->address}}">
                                            @error('address')
                                            <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-30">
                                            <label>Số điện thoại <span>*</span></label>
                                            <input type="text" name="phone" value="{{$user->phone}}">
                                            @error('phone')
                                            <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-30">
                                            <label>Ghi chú </label>
                                            <textarea name="note" style="background: none;resize: none;" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <h3>Đơn hàng</h3>
                                <div class="order_table table-responsive mb-30">
                                    <table>
                                        <thead>
                                            <tr style="font-size: 16px;">
                                                <th>Hình ảnh</th>
                                                <th>Thông tin sản phẩm</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(Session::has('cart'))
                                            @foreach($product_cart as $cart)
                                            <tr>
                                                <td><img src="{{asset('frontend/image/product/'.$cart['item']['image'])}}" style="width: 80px;height: 80px;" alt=""></td>
                                                <td> <a href="{{route('product_detail',$cart['item']['id'])}}" style="font-size: 16px;color: #000;">{{$cart['item']['name']}}</a><br>
                                                <a>Kích thước: {{$cart['size_name']}}</a> -
                                                <a>Số lượng: {{$cart['qty']}}</a>

                                                </td>
                                                <td>
                                                    @if($cart['item']['promotion_price']==0)
                                                    {{number_format($cart['item']['unit_price']*$cart['qty'],0," ",".")}} đ
                                                    @else
                                                    {{number_format($cart['item']['promotion_price']*$cart['qty'],0," ",".")}} đ
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="order_total">
                                        <h4 style="margin-top: 20px; margin-bottom: 10px;; font-family: Arial;">Tổng tiền:
                                            @if(Session::has('cart'))
                                            {{number_format(Session('cart')->totalPrice,0," ",".")}}
                                            @else 0
                                            @endif đồng
                                        </h4>
                                    </div>
                                </div>
                                <div class="payment_method">
                                    <h3>Hình thức thanh toán</h3>
                                    <div class="panel-default" style="margin-left: 20px; margin-top: 20px;">
                                        <input id="payment" checked name="payment" value="COD" type="radio" data-target="createp_account">
                                        <label for="payment" data-toggle="collapse" data-target="#method" aria-controls="method">Thanh toán khi nhận hàng.</label>
                                        <div style="background: #eee;">
                                            <div class="payment_box payment_method_bacs" style="display: block;font-size:18px;padding-left: 10px;padding-top: 10px;padding-bottom: 10px; padding-right: 6px;font-family: Arial, Helvetica, sans-serif;">
                                                Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                            </div>
                                        </div>
                                    </div>
                                    <center>
                                        <div style="margin-top: 50px;font-family: Arial;" class="order_button">
                                            <button type="submit">Đặt hàng</button>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action = "https://me.momo.vn/qr-page/P2P/BeCung">
                        <div style="margin-top: 50px;font-family: Arial;" class="order_button">
                        <button>
                            Thanh toán MOMO
                        </button>
                        </div>
                        <div style="background: #eee;">

                         </div>
                    </form>
                    <form action = "">
                        <div style="margin-top: 5px;font-family: Arial;" class="order_button">
                        <button>
                            Thanh toán VNPAY
                        </button>
                        </div>
                        <div style="background: #eee;">
                            <div class="payment_box payment_method_bacs" style="display: block;font-size:18px;padding-left: 10px;padding-top: 10px;padding-bottom: 10px; padding-right: 6px;font-family: Arial, Helvetica, sans-serif;"> Khách hàng có thể chuyển tiền trực tiếp thông qua số tài khoản MOMO hoặc VNPAYcủa người dùng "Phạm Thị Quỳnh Son", nhân viên tư vấn sẽ  trong vòng 5 phút sẽ liên hệ ngay đến khách hàng.
                            </div>
                         </div>
                    </form>
                </div>
                @else
                <div class="row">
                    <div class="col-12">

                        <div class="user-actions mb-20">
                            <h3>
                                <div style="color: #00bba6; font-size:20px;">{{Session::get('success')}} <a class="Returning" href="{{route('order')}}" >Xem đơn hàng đã đặt</a></div>

                            </h3>
                        </div>
                        <div class="user-actions mb-20">
                            <h3>
                            <div style="color: #00bba6; font-size:20px;">Giỏ hàng trống! <a class="Returning" href="{{route('home')}}" >Về trang chủ</a></div>

                            </h3>
                        </div>

                    </div>
                </div>
                @endif
            </div>
            <!--Checkout page section end-->
        </div>
        <!--pos page inner end-->
    </div>
</div>
<!--pos page end-->
@endsection
