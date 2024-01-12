@extends('page.layout.master')
@section('content')
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
                                <li>Tìm kiếm</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumbs area end-->

            <!--pos home section-->
            <div class=" pos_home_section shop_section shop_fullwidth">
                <!--shop tab product-->
                <div class="shop_tab_product shop_fullwidth">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="large" role="tabpanel">
                            <div class="row">
                                @foreach($product_search as $search)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="single_product">
                                        <div class="product_thumb">
                                            <a href="{{route('product_detail',$search->id)}}"><img src="{{asset('frontend/image/product/'.$search->image)}}" width="100%" height="320px;" ; alt=""></a>
                                            @if($search->promotion_price!=0)
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>
                                            @endif
                                            <div class="product_action">
                                            <a href="javascript:" onclick="AddCart('{{$search->id}}')"> <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng</a>
                                            </div>
                                        </div>
                                        <div class="product_content" style="margin-top: 15px;">
                                            <h3 class="product_title"><a href="{{route('product_detail',$search->id)}}">{{$search->name}}</a></h3>
                                        </div>
                                        <div class="modal_price mb-10" style="margin-top: 10px;">
                                            @if($search->promotion_price==0)
                                            <span class="new_price">{{number_format($search->unit_price,0," ",".")}} ₫</span>
                                            @else
                                            <span class="new_price">{{number_format($search->promotion_price,0," ",".")}} ₫</span>
                                            <span class="old_price">{{number_format($search->unit_price,0," ",".")}} ₫</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div>{{$product_search->appends(request()->query())->links('vendor.pagination.bootstrap-4')}}</div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function AddCart(id) {
            // $('#disabled_add').addClass('disabled');
            $.ajax({
                url: '/add-to-cart/' + id,
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
    </script>
@endsection
