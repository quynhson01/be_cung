@extends('page.layout.master')
@section('content')
<style>
    .cart_button .active {
        background: #018576;
    }

    .activestars {
        color: #FFD700 !important;
    }

    .noHover {
        pointer-events: none;
    }

    div.stars {
        width: 270px;
        display: inline-block;
    }

    input.star {
        display: none;
    }

    label.star {
        float: right;
        padding: 10px;
        font-size: 36px;
        color: #444;
        transition: all .2s;
    }

    input.star:checked~label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s;
    }

    input.star-5:checked~label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952;
    }

    input.star-1:checked~label.star:before {
        color: #F62;
    }

    label.star:hover {
        transform: rotate(-15deg) scale(1.3);
    }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome;
    }
</style>
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
                                <li>{{$name_brands->name}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumbs area end-->

            <!--pos home section-->
            <div class=" pos_home_section shop_section shop_fullwidth">
                <div class="row">
                    <div class="col-12">
                        <!--banner slider start-->
                        <div class="brand_logo brand_two">
                            <div class="block_title">
                                <h3>Thương hiệu</h3>
                            </div>
                            <div class="row">
                                <div class="brand_active owl-carousel">
                                    @foreach($brands as $brand)
                                    @if(count($brand->product) > 0)
                                    <div class="col-lg-2">
                                        <div class="single_brand">
                                            <a href="{{route('product_brands',$brand->id)}}"><img src="{{asset('frontend/image/brands/'.$brand->image)}}" width="100px" height="100px" alt=""></a>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!--banner slider start-->
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-12">
                        <!--shop toolbar start-->
                        <div class="shop_toolbar mb-35" style="margin-bottom: 0px;">
                            <div class="cart_button">
                                <a class="{{Request::get('price') == 1 ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['price'=>1])}}" style="margin-top: 0px;">Dưới 200K</a>
                                <a class="{{Request::get('price') == 2 ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['price'=>2])}}" style="margin-top: 0px;">Từ 200K - 400k</a>
                                <a class="{{Request::get('price') == 3 ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['price'=>3])}}" style="margin-top: 0px;">Từ 400K - 600k</a>
                                <a class="{{Request::get('price') == 4 ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['price'=>4])}}" style="margin-top: 0px;">Từ 600K - 800k</a>
                                <a class="{{Request::get('price') == 5 ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['price'=>5])}}" style="margin-top: 0px;">Từ 800K - 1 triệu</a>
                                <a class="{{Request::get('price') == 6 ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['price'=>6])}}" style="margin-top: 0px;">Từ 1 triệu - 1 triệu 500k </a>
                                <a class="{{Request::get('price') == 7 ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['price'=>7])}}" style="margin-top: 0px;">Từ 1 triệu 500k - 2 triệu</a>
                                <a class="{{Request::get('price') == 8 ? 'active' : ''}}" href="{{request()->fullUrlWithQuery(['price'=>8])}}" style="margin-top: 0px;">Trên 2 triệu</a>
                            </div>
                        </div>
                        <!--shop toolbar end-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!--shop toolbar start-->
                        <div class="shop_toolbar mb-35">
                            <div class="list_button">
                                <ul class="nav" role="tablist">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#large" role="tab" aria-controls="large" aria-selected="true"><i class="fa fa-th-large"></i></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="false"><i class="fa fa-th-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="page_amount"></div>
                            <div class="select_option">
                                <form id="product_orderby" method="get">
                                    <label>Sắp xếp theo</label>
                                    <select name="orderby" id="short" class="orderby">
                                        <option {{Request::get('orderby') == "none" || !Request::get('orderby') ? "selected = 'selected'" : ""}} selected="" value="none">Mặt định</option>
                                        <option {{Request::get('orderby') == "new" ? "selected = 'selected'" : ""}} value="new">Mới nhất</option>
                                        <option {{Request::get('orderby') == "hot" ? "selected = 'selected'" : ""}} value="hot">Nổi bật</option>
                                        <option {{Request::get('orderby') == "promotion" ? "selected = 'selected'" : ""}} value="promotion">Khuyến mãi</option>
                                        <option {{Request::get('orderby') == "min" ? "selected = 'selected'" : ""}} value="min">Giá giảm dần</option>
                                        <option {{Request::get('orderby') == "max" ? "selected = 'selected'" : ""}} value="max">Giá tăng dần</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <!--shop toolbar end-->
                    </div>
                </div>

                <!--shop tab product-->
                <div class="shop_tab_product shop_fullwidth">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active owl-carousel" id="large" role="tabpanel">
                            @if(count($product_brands) > 0)
                            <div class="row">
                                @foreach($product_brands as $brands)
                                <div class="col-lg-3 col-md-4 col-sm-6" style="margin-bottom: 20px;">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a href="{{route('product_detail',$brands->id)}}"><img src="{{asset('frontend/image/product/'.$brands->image)}}" width="100%" height="320px;" alt=""></a>
                                            @if($brands->quantity==0)
                                            <div class="img_icone">
                                                <span style="position: absolute;background: #ea3a3c;width: 85px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 16px;">Hết hàng</span>
                                            </div>
                                            @endif
                                            @if($brands->promotion_price!=0)
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>
                                            @endif
                                            <div class="product_action">
                                                <a href="{{route('product_detail',$brands->id)}}">Chi tiết <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="product_content" style="margin-top: 15px;">
                                            <h3 class="product_title"><a href="{{route('product_detail',$brands->id)}}">{{$brands->name}}</a></h3>
                                        </div>
                                        <div class="modal_price mb-10" style="margin-top: 10px;">
                                            @if($brands->promotion_price==0)
                                            <span class="new_price">{{number_format($brands->unit_price,0," ",".")}} ₫</span>
                                            @else
                                            <span class="new_price">{{number_format($brands->promotion_price,0," ",".")}} ₫</span>
                                            <span class="old_price">{{number_format($brands->unit_price,0," ",".")}} ₫</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div>{{$product_brands->appends(request()->query())->links('vendor.pagination.bootstrap-4')}}</div>
                            @else
                            <div class="row">
                                <div class="col-12">
                                    <div class="user-actions mb-20">
                                        <h3>
                                            <div style="color: #e84c3d; font-size:20px;">Không tìm thấy sản phẩm!</div>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="list" role="tabpanel">
                            @if(count($product_brands) > 0)
                            @foreach($product_brands as $brands)
                            <div class="product_list_item mb-35">
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-md-5 col-sm-6">
                                        <div class="product_thumb">
                                            <a href="{{route('product_detail',$brands->id)}}"><img src="{{asset('frontend/image/product/'.$brands->image)}}" width="100%" height="348px;" alt=""></a>
                                            @if($brands->quantity==0)
                                            <div class="img_icone">
                                                <span style="position: absolute;background: #ea3a3c;width: 85px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 16px;">Hết hàng</span>
                                            </div>
                                            @endif
                                            @if($brands->promotion_price!=0)
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-7 col-sm-6">
                                        <div class="list_product_content">
                                            <div class="list_title">
                                                <h3><a href="{{route('product_detail',$brands->id)}}">{{$brands->name}}</a></h3>
                                            </div>
                                            <div class="product_ratting">
                                                @if($brands)
                                                <?php
                                                $product_ra = 0;
                                                if ($brands->total_ra) {
                                                    $product_ra = round($brands->total_number / $brands->total_ra, 2);
                                                }
                                                ?>
                                                @for($i=1; $i<=5; $i++) <i class="fa fa-star {{$i <= $product_ra ? 'activestars' : ''}}" style="font-size:16px;color:#999;"></i>
                                                    @endfor
                                                    <a style="margin-left: 10px;color: #ea3a3c;">{{$brands->total_ra}} đánh giá</a>
                                                    @endif
                                            </div>
                                            <div class="design">{!!$brands->description!!}</div>

                                            <div class="modal_price mb-10" style="margin-top: 10px;">
                                                @if($brands->promotion_price==0)
                                                <span class="new_price">{{number_format($brands->unit_price,0," ",".")}} ₫</span>
                                                @else
                                                <span class="new_price">{{number_format($brands->promotion_price,0," ",".")}} ₫</span>
                                                <span class="old_price">{{number_format($brands->unit_price,0," ",".")}} ₫</span>
                                                @endif

                                            </div>
                                            <div class="product_d_size mb-20">
                                                <label for="group_1" style="text-transform:none; font-family: Arial, Helvetica, sans-serif;line-height: 22px;">Trạng thái: &nbsp;
                                                    @if($brands->quantity==0)
                                                    <span style="position: absolute;background: #ea3a3c;width: 77px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 13px;line-height:20px;">Hết hàng</span></label>
                                                @else
                                                <span style="position: absolute;background: #5cb85c;width: 81px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 13px;line-height:20px">Còn hàng</span></label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div>{{$product_brands->appends(request()->query())->links('vendor.pagination.bootstrap-4')}}</div>
                            @else
                            <div class="row">
                                <div class="col-12">
                                    <div class="user-actions mb-20">
                                        <h3>
                                            <div style="color: #e84c3d; font-size:20px;">Không tìm thấy sản phẩm!</div>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--shop tab product end-->

            </div>
            <!--pos home section end-->
        </div>
        <!--pos page inner end-->
    </div>
</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
<!-- <script>
    function AddCart(id) {
        // $('#disabled_add').addClass('disabled');
        $.ajax({
            url: '/wmfashion/add-to-cart/' + id,
            type: 'GET'
        }).done(function(response) {
            console.log(response);
            $('#total_qty_header').html(response.totalQty);
            $('#total_price_header').html(Number(response.totalPrice).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
            //total_qty_header
            Swal.fire({
                icon: 'success',
                title: 'Đã thêm vào giỏ hàng',
                showConfirmButton: false,
                timer: 1500
            })
            //  $('#disabled_add').removeClass('disabled');
        })
    }
</script> -->
@endsection
@section('script')
<script>
    $('.orderby').change(function() {
        $('#product_orderby').submit();
    })
</script>
@endsection
