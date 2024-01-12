@extends('page.layout.master')
@section('content')
<div class="pos_home_section">
    <div class="row">
        <!--banner slider start-->
        <div class="col-12">
            <div class="banner_slider slider_two">
                <div class="slider_active owl-carousel" id="mySlides">
                    @foreach($slides as $slide)
                    <div class="single_slider" style="background-image: url(image/slide/{{$slide->image}})">
                    </div>
                    @endforeach
                </div>
            </div>
            <!--banner slider start-->
        </div>
    </div>
    <!--new product area start-->
    <div class="new_product_area product_two">
        <div class="row">
            <div class="col-12">
                <div class="block_title">
                    <h3>Sản phẩm mới</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="single_p_active owl-carousel">
                @foreach($new_products as $new)
                <div class="col-lg-3">
                    <div class="single_product">
                        <div class="product_thumb">
                            <a href="{{route('product_detail',$new->id)}}"><img src="{{asset('frontend/image/product/'.$new->image)}}" width="100%" height="320px;" alt=""></a>
                            @if($new->quantity==0)
                            <div class="img_icone">
                                <span style="position: absolute;background: #ea3a3c;width: 85px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 16px;">Hết hàng</span>
                            </div>
                            @endif
                            @if($new->promotion_price!=0)
                            <div class="ribbon-wrapper">

                                <div class="ribbon sale">Sale</div>
                            </div>
                            @endif
                            <div class="product_action">
                                <a href="{{route('product_detail',$new->id)}}">Chi tiết <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="product_content" style="margin-top: 15px;">
                            <h3 class="product_title"><a href="{{route('product_detail',$new->id)}}">{{$new->name}}</a></h3>
                        </div>
                        <div class="modal_price mb-10" style="margin-top: 10px;">
                            @if($new->promotion_price==0)
                            <span class="new_price">{{number_format($new->unit_price,0," ",".")}} ₫</span>
                            @else
                            <span class="new_price">{{number_format($new->promotion_price,0," ",".")}} ₫</span>
                            <span class="old_price">{{number_format($new->unit_price,0," ",".")}} ₫</span>
                            @endif

                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="space40">&nbsp;</div>
    </div>
    <!--new product area start-->
    <div class="new_product_area product_two">
        <div class="row">
            <div class="col-12">
                <div class="block_title">
                    <h3> Sản phẩm khuyến mãi</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="single_p_active owl-carousel">
                @foreach($promotion_product as $promotion)
                <div class="col-lg-3">
                    <div class="single_product">
                        <div class="product_thumb">
                            <a href="{{route('product_detail',$promotion->id)}}"><img src="{{asset('frontend/image/product/'.$promotion->image)}}" width="100%" height="320px;" alt=""></a>
                            @if($promotion->quantity==0)
                            <div class="img_icone">
                                <span style="position: absolute;background: #ea3a3c;width: 85px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 16px;">Hết hàng</span>
                            </div>
                            @endif
                            <div class="ribbon-wrapper">
                                <div class="ribbon sale">Sale</div>
                            </div>
                            <div class="product_action">
                                <a href="{{route('product_detail',$promotion->id)}}">Chi tiết <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="product_content" style="margin-top: 15px;">
                            <h3 class="product_title" style="text-transform:none;"><a href="{{route('product_detail',$promotion->id)}}">{{$promotion->name}}</a></h3>
                        </div>
                        <div class="modal_price mb-10" style="margin-top: 10px;">
                            @if($promotion->promotion_price==0)
                            <span class="new_price">{{number_format($promotion->unit_price,0," ",".")}} ₫</span>
                            @else
                            <span class="new_price">{{number_format($promotion->promotion_price,0," ",".")}} ₫</span>
                            <span class="old_price">{{number_format($promotion->unit_price,0," ",".")}} ₫</span>
                            @endif

                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="space40">&nbsp;</div>
    <div class="space40">&nbsp;</div>
    <!--banner area start-->
    <div class="banner_area banner_two">
        <div class="row">
            @foreach($sale_banner as $sale)
            <div class="col-lg-4 col-md-6">
                <div class="single_banner">
                    <a href="{{route('sale_product')}}"><img src="{{asset('frontend/image/sale_banner/'.$sale->image)}}" height="180px;" alt=""></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!--banner area end-->

    <div class="new_product_area product_two">
        <div class="row">
            <div class="col-12">
                <div class="block_title">
                    <h3> Sản phẩm nổi bật</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="single_p_active owl-carousel">
                @foreach($highlights_product as $highlights)
                <div class="col-lg-3">
                    <div class="single_product">
                        <div class="product_thumb">
                            <a href="{{route('product_detail',$highlights->id)}}"><img src="{{asset('frontend/image/product/'.$highlights->image)}}" width="100%" height="320px;" alt=""></a>
                            @if($highlights->quantity==0)
                            <div class="img_icone">
                                <span style="position: absolute;background: #ea3a3c;width: 85px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 16px;">Hết hàng</span>
                            </div>
                            @endif
                            <div class="ribbon-wrapper">
                                <div class="ribbon sale">Sale</div>
                            </div>
                            <div class="product_action">
                                <a href="{{route('product_detail',$highlights->id)}}">Chi tiết <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="product_content" style="margin-top: 15px;">
                            <h3 class="product_title" style="text-transform:none;"><a href="{{route('product_detail',$highlights->id)}}">{{$highlights->name}}</a></h3>
                        </div>
                        <div class="modal_price mb-10" style="margin-top: 10px;">
                            @if($highlights->promotion_price==0)
                            <span class="new_price">{{number_format($highlights->unit_price,0," ",".")}} ₫</span>
                            @else
                            <span class="new_price">{{number_format($highlights->promotion_price,0," ",".")}} ₫</span>
                            <span class="old_price">{{number_format($highlights->unit_price,0," ",".")}} ₫</span>
                            @endif

                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="space40">&nbsp;</div>
    <!--featured product area start-->
    <div class="new_product_area product_two">
        <div class="row">
            <div class="col-12">
                <div class="block_title">
                    <h3> Sản phẩm bán chạy</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="single_p_active owl-carousel">
                @foreach($best_product as $best)
                <div class="col-lg-3">
                    <div class="single_product">
                        <div class="product_thumb">
                            <a href="{{route('product_detail',$best->id)}}"><img src="{{asset('frontend/image/product/'.$best->image)}}" width="100%" height="320px;" alt=""></a>
                            @if($best->quantity==0)
                            <div class="img_icone">
                                <span style="position: absolute;background: #ea3a3c;width: 85px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 16px;">Hết hàng</span>
                            </div>
                            @endif
                            <div class="ribbon-wrapper">
                                <div class="ribbon sale">Sale</div>
                            </div>
                            <div class="product_action">
                                <a href="{{route('product_detail',$best->id)}}">Chi tiết <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="product_content" style="margin-top: 15px;">
                            <h3 class="product_title" style="text-transform:none;"><a href="{{route('product_detail',$best->id)}}">{{$best->name}}</a></h3>
                        </div>
                        <div class="modal_price mb-10" style="margin-top: 10px;">
                            @if($best->promotion_price==0)
                            <span class="new_price">{{number_format($best->unit_price,0," ",".")}} ₫</span>
                            @else
                            <span class="new_price">{{number_format($best->promotion_price,0," ",".")}} ₫</span>
                            <span class="old_price">{{number_format($best->unit_price,0," ",".")}} ₫</span>
                            @endif

                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--  -->
    <div class="space40">&nbsp;</div>
    <!--featured product area start-->
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
</div>
<div class="space40">&nbsp;</div>
@endsection