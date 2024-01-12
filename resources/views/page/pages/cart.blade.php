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
                                <li>Giỏ hàng</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumbs area end-->
            <!--shopping cart area start -->
            <div class="shopping_cart_area">
                @if(Session::has('cart')>=1)
                @if($errors->any())
                <div id="error" class="row">
                    <div class="col-12">
                        <div class="user-actions mb-20">
                            <h3>
                                <div style="color: #00bba6; font-size:18px;font-family: Arial;"><a class="Returning" href="{{route('home')}}">{{$errors->first()}}</a></div>

                            </h3>
                        </div>

                    </div>
                </div>

                @endif
                <form>
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="cart_page">
                                    <table class="table table-bordered" style="font-size: 18px;font-family: Arial;">
                                        <thead>
                                            <tr>

                                                <th width="10%">Hình ảnh</th>
                                                <th width="20%">Tên sản phẩm</th>
                                                <th width="15%">Kích thước</th>
                                                <th width="15%">Giá</th>
                                                <th width="15%">Số lượng</th>
                                                <th width="15%">Tổng tiền</th>
                                                <th width="10%">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if(Session::has('cart'))
                                            @foreach($product_cart as $cart)
                                            <tr>
                                                <td class="product_thumb"><a href="{{route('product_detail',$cart['item']['id'])}}"><img src="{{asset('frontend/image/product/'.$cart['item']['image'])}}" style="width: 100px;height: 100px;" alt=""></a></td>
                                                <td class="product_name"><a href="{{route('product_detail',$cart['item']['id'])}}">{{$cart['item']['name']}}</a></td>
                                                <td>{{$cart['size_name']}}</td>
                                                <td class="product-price">
                                                    @if($cart['item']['promotion_price']==0)
                                                    {{number_format($cart['item']['unit_price'])}} đ
                                                    @else
                                                    {{number_format($cart['item']['promotion_price'])}} đ
                                                    @endif
                                                </td>

                                                <td class="product_quantity">
                                                    <div><input class="min_quantity" id="qty-{{$cart['item']['id']}}{{$cart['size_name']}}" onchange="changeQuantity(this)" style="background: #fff;font-size: 18px;" min="1" type="number" value="{{$cart['qty']}}"></div><br>

                                                </td>
                                                <td id="total-{{$cart['item']['id']}}{{$cart['size_name']}}" class="product_total">
                                                    @if($cart['item']['promotion_price']==0)
                                                    {{number_format($cart['item']['unit_price']*$cart['qty'])}} đ
                                                    @else
                                                    {{number_format($cart['item']['promotion_price']*$cart['qty'])}} đ
                                                    @endif
                                                </td>
                                                <td class="product_remove">
                                                    <a class="btn-sm" data-url="{{route('delete_carts',$cart['item']['id'])}}" data-size="{{$cart['size_name']}}"><i style="margin-top: 40%;margin-left: 30%;font-size: 25px;" class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart_submit">
                                    <h4 style="margin-top: 5px; margin-bottom: 20px; font-family: Arial;">Tổng tiền: <span id="totalprice">{{number_format(Session('cart')->totalPrice)}} đ</span> </h4>
                                    <button style="background: #00bba6; color: #fff;"><a style="color: #fff;" href="{{route('checkout')}}">Đặt hàng</a></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                @else
                <div class="row">
                    <div class="col-12">
                        <div class="user-actions mb-20">
                            <h3>
                                <div style="color: #00bba6; font-size:20px;">Giỏ hàng trống! <a class="Returning" href="{{route('home')}}">Về trang chủ</a></div>

                            </h3>
                        </div>

                    </div>
                </div>
                @endif
            </div>
            <!--shopping cart area end -->

        </div>
        <!--pos page inner end-->
    </div>
</div>
<!--pos page end-->
<script>
    // const base_url = window.location.origin;

    function changeQuantity(inputQuantity) {
        let [x, id] = inputQuantity.id.split('-');
        let _token = document.getElementById('_token');
        var quantity_min = inputQuantity.value;
            requestCart("{{route('cart')}}", JSON.stringify({
            '_token': _token.value,
            'id': id,
            'quantity': inputQuantity.value
        }), function(data) {
            data = JSON.parse(data);
            console.log(data);
            if (quantity_min >= 1) {
            document.getElementById('total-' + data['id']).innerHTML = Number(data['cart']['items'][data['id']]['price']).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ';
            document.getElementById('totalprice').innerHTML = Number(data['cart']['totalPrice']).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ';
            // document.getElementById('qty_header-' + data['id']).innerHTML = data['cart']['items'][data['id']]['qty'];
            // document.getElementById('total_price_header1').innerHTML = Number(data['cart']['totalPrice']).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ';
            document.getElementById('total_price_header').innerHTML = Number(data['cart']['totalPrice']).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ';
            document.getElementById('total_qty_header').innerHTML = data['cart']['totalQty'];
            } else {
				Swal.fire({
					icon: 'error',
					title: 'Số lượng phải lớn hơn 0',
					showConfirmButton: false,
					timer: 1500
				})
				inputQuantity.value = data['cart']['items'][data['id']]['qty'];
			}
        });
    }

    //
    function requestCart(url = "", para = "", callbackSuccess = function() {}, callbackError = function(err) {
        console.log(err)
    }) {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                callbackSuccess(this.responseText);
            } else if (this.readyState == 4 && this.status == 500) {
                callbackError(this.responseText);
            }
        }
        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-type", "application/json");
        xmlHttp.send(para);
    }
</script>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).on('click', '.btn-sm', DelCart);

    function DelCart(e) {
        e.preventDefault();
        let urlRequest = $(this).data('url');
        let size = $(this).attr('data-size');
        let that = $(this);
        Swal.fire({
            title: 'Xóa',
            text: "Bạn có muốn xóa không!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có',
            cancelButtonText: 'Không',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: urlRequest,
                    data: {
                        size: size
                    },
                    type: 'GET',
                    success: function(data) {
                        if (data.code == 200) {
                            document.getElementById('totalprice').innerHTML = Number(data['cart']['totalPrice']).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ';
                            document.getElementById('total_price_header').innerHTML = Number(data['cart']['totalPrice']).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                            document.getElementById('total_qty_header').innerHTML = data['cart']['totalQty'];
                            that.parent().parent().remove();
                            Swal.fire(
                                'Xóa',
                                'Xóa thành công.',
                                'success'
                            )
                        }
                        $('#error').html('');
                    }
                });
            }
        });
    }
</script>
@stop
