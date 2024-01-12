@extends('page.layout.master')
@section('content')
<style>
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
                            <ul style="font-family: Arial, Helvetica, sans-serif;">
                                <li><a href="{{route('home')}}">Trang chủ</a></li>
                                <li><i class="fa fa-angle-right"></i></li>
                                <li>Chi tiết sản phẩm</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumbs area end-->

            <!--product wrapper start-->
            <div class="product_details">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="product_tab fix">
                            @if($product_detail->images)
                            <div class="product_tab_button">
                                <ul class="nav" role="tablist">
                                    @for($i=0; $i<3; $i++)
                                    @if($product_detail->images[$i])
                                    <li>
                                        <a class="active " data-toggle="tab" href="#p_tab1" role="tab" aria-controls="p_tab1" aria-selected="false"><img class="image-detail" src="{{asset('frontend/image/products/'.$product_detail->images[$i])}}" height="110px" alt=""></a>
                                    </li>
                                    @endif
                                    @endfor
                                </ul>
                            </div>
                            @endif
                            <div class="tab-content produc_tab_c">
                                <div class="tab-pane fade show active" id="p_tab1" role="tabpanel">
                                    <div class="modal_img">
                                        <a><img id="image-main" src="{{asset('frontend/image/product/'.$product_detail->image)}}" width="500px" height="375px" alt=""></a>
                                        @if($product_detail->quantity==0)
                                        <div class="img_icone">
                                            <span style="position: absolute;background: #ea3a3c;width: 85px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 16px;">Hết hàng</span>
                                        </div>
                                        @endif
                                        @if($product_detail->promotion_price!=0)
                                        <div class="ribbon-wrapper">
                                            <div class="ribbon sale">Sale</div>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="product_d_right">
                            <h1 style="text-transform:none;font-family:Arial, Helvetica, sans-serif">{{$product_detail->name}}</h1>

                            <div class="product_ratting mb-10">
                                @if($ratings['product'])
                                <?php
                                $product_ra = 0;
                                if ($ratings['product']->total_ra) {
                                    $product_ra = round($ratings['product']->total_number / $ratings['product']->total_ra, 2);
                                }
                                ?>
                                @for($i=1; $i<=5; $i++) <i class="fa fa-star {{$i <= $product_ra ? 'activestars' : ''}}" style="font-size:16px;color:#999;"></i>
                                    @endfor
                                    <a style="margin-left: 10px;color: #ea3a3c;">{{$ratings['product']->total_ra}} đánh giá</a>
                                    @endif
                            </div>
                            <div class="product_desc">
                                {!!$product_detail->description!!}
                            </div>

                            <div class="modal_price mb-10">
                                @if($product_detail->promotion_price==0)
                                <span class="new_price">{{number_format($product_detail->unit_price,0," ",".")}} ₫</span>
                                @else
                                <span class="new_price">{{number_format($product_detail->promotion_price,0," ",".")}} ₫</span>
                                <span class="old_price">{{number_format($product_detail->unit_price,0," ",".")}} ₫</span>
                                @endif
                            </div>
                            <div class="product_d_size mb-20">
                                <label for="group_1" style="text-transform:none; font-family: Arial, Helvetica, sans-serif;line-height: 22px;">Trạng thái: &nbsp;
                                    @if($product_detail->quantity==0)
                                    <span style="position: absolute;background: #ea3a3c;width: 77px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 13px;line-height:20px;">Hết hàng</span></label>
                                @else
                                <span style="position: absolute;background: #5cb85c;width: 81px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 13px;line-height:20px">Còn hàng</span></label>
                                @endif
                            </div>
                            <form>
                                <div class="product_d_size mb-20">
                                    <label for="group_1">Kích thước</label>
                                    <select name="id_size" id="group_1" class="size-selected">
                                        <option value="">Chọn</option>
                                        @foreach($product_detail->size as $size)
                                        @if($size->quantity != 0)
                                        <option value="{{$size->id}}">{{$size->size}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                            <div class="add_links">
                                <!-- <a id="disabled_add" class="btn btn-primary btn-lg" title="Thêm giỏ hàng" role="button" aria-disabled="true"  onclick="AddCart('{{$product_detail->id}}')"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a> -->
                                <ul>
                                    <li><a href="javascript:" title="Thêm giỏ hàng" onclick="AddCart('{{$product_detail->id}}')"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--product details end-->

            <!--product info start-->
            <div class="product_d_info">
                <div class="row">
                    <div class="col-12">
                        <div class="product_d_inner">
                            <div class="product_info_button">
                                <ul class="nav" role="tablist">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Mô tả</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="info" role="tabpanel">
                                    <div class="product_info_content">
                                        {!!$product_detail->long_description!!}
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    @if(Auth::check())
                                    <div class="product_review_form">
                                        @if(count($errors)>0)
                                        <div class="alert alert-danger" style="font-size: 16px;">
                                            @foreach($errors->all() as $err)
                                            {{$err}}.
                                            @endforeach
                                        </div>
                                        @endif
                                        @if($ratings['rating_user'])
                                        <?php
                                        $rating_show_user = 0;
                                        if ($ratings['rating_user']->stars) {
                                            $rating_show_user = $ratings['rating_user']->stars;
                                        }
                                        ?>
                                        <div class="product_info_content" style="margin-bottom: 20px;">
                                            <h5>Đánh giá của bạn</h5>
                                            <h6 style="margin-top: 5px;">{{$ratings['rating_user']->user->full_name}} </h6>
                                            <div class="product_info_inner">
                                                @for($i=1; $i<=5; $i++) <div id="rating">
                                                    <i class="fa fa-star {{$i <= $rating_show_user ? 'activestars' : ''}}" style="font-size:16px;color:#999;margin-left: 3px;"></i>
                                            </div>
                                            @endfor
                                            <div>
                                                <strong style="margin-left: 10px;">{{$ratings['rating_user']->created_at->format('d/m/Y')}}</strong>
                                            </div>
                                        </div>
                                        <p style="margin-bottom: 7px;">{{$ratings['rating_user']->content}}</p>
                                        @else
                                        <form action="{{route('rating',$product_detail->id)}}" method="post">
                                            @csrf()
                                            <div class="row">
                                                <div class="col-6" style="margin-left: 38%;">
                                                    <div class="stars">
                                                        <input class="star star-5" id="star-5" type="radio" name="rating" value="5" />
                                                        <label class="star star-5" for="star-5"></label>
                                                        <input class="star star-4" id="star-4" type="radio" name="rating" value="4" />
                                                        <label class="star star-4" for="star-4"></label>
                                                        <input class="star star-3" id="star-3" type="radio" name="rating" value="3" />
                                                        <label class="star star-3" for="star-3"></label>
                                                        <input class="star star-2" id="star-2" type="radio" name="rating" value="2" />
                                                        <label class="star star-2" for="star-2"></label>
                                                        <input class="star star-1" id="star-1" type="radio" name="rating" value="1" />
                                                        <label class="star star-1" for="star-1"></label>
                                                    </div>

                                                </div>
                                                <div class="col-12">
                                                    <h5>Viết đánh giá</h5>
                                                    <textarea name="content" placeholder="Đánh giá sản phẩm(không bắt buộc)" id="review_comment"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" style="font-family: Arial;text-transform:none;margin-left: 95%;">Gửi</button>
                                        </form>

                                        @endif
                                    </div>
                                    @else
                                    <div class="product_review_form">
                                        @if(Session::has('error'))
                                        <div style="font-size: 18px;" class="alert alert-danger">{{Session::get('error')}}.</div>
                                        @endif
                                        <form action="{{route('login_detail',$product_detail->id)}}" method="post">
                                            @csrf
                                            <h2>Đăng nhập</h2>
                                            <p>Đăng nhập để đánh giá sản phẩm</p>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="email" style="color: #000;">Email</label>
                                                    <input id="email" type="text" name="email" placeholder="Email...">
                                                    @error('email')
                                                    <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                                    @enderror
                                                </div><br>
                                                <div class="col-6">
                                                    <label for="author" style="color: #000;">Mật khẩu</label>
                                                    <input id="author" type="password" name="password" placeholder="******">
                                                    @error('password')
                                                    <div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <button type="submit">Đăng nhập</button>
                                        </form>
                                    </div>
                                    @endif
                                    @if(count($rating)>0)
                                    <h5>Tất cả đánh giá</h5>
                                    @endif
                                    @foreach($rating as $ra)
                                    <?php
                                    $rating_show = 0;
                                    if ($ra->stars) {
                                        $rating_show = $ra->stars;
                                    }
                                    ?>
                                    <div class="product_info_content" style="border-bottom: 1px solid #009483;">
                                        <h6 style="margin-top: 10px;">{{$ra->user->full_name}} </h6>
                                        <div class="product_info_inner" style="margin-top: 0px;">
                                            @for($i=1; $i<=5; $i++) <div id="rating">
                                                <i class="fa fa-star {{$i <= $rating_show ? 'activestars' : ''}}" style="font-size:16px;color:#999;margin-left: 3px;"></i>
                                        </div>
                                        @endfor
                                        <div>
                                            <strong style="margin-left: 10px;">{{$ra->created_at->format('d/m/Y')}}</strong>
                                        </div>
                                    </div>
                                    <p style="margin-bottom: 7px;">{{$ra->content}}</p>
                                </div>
                                @endforeach
                                <div style="margin-top: 10px;" class="row">{{$rating->links('vendor.pagination.bootstrap-4')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--product info end-->
        <div class="space40">&nbsp;</div>
        <!--new product area start-->
        <div class="new_product_area product_page">
            <div class="row">
                <div class="col-12">
                    <div class="block_title">
                        <h3>Sản phẩm liên quan</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="single_p_active owl-carousel">
                    @foreach($related_product as $related)
                    <div class="col-lg-3">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a href="{{route('product_detail',$related->id)}}"><img src="{{asset('frontend/image/product/'.$related->image)}}" height="310px;" alt=""></a>
                                @if($related->quantity==0)
                                <div class="img_icone">
                                    <span style="position: absolute;background: #ea3a3c;width: 85px;color: #fff;border-radius: 5px;padding: 2px 10px;font-size: 16px;">Hết hàng</span>
                                </div>
                                @endif
                                @if($related->promotion_price!=0)
                                <div class="ribbon-wrapper">
                                    <div class="ribbon sale">Sale</div>
                                </div>
                                @endif
                                <div class="product_action">
                                <a href="{{route('product_detail',$related->id)}}">Chi tiết <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="product_content" style="margin-top: 15px;">
                                <h3 class="product_title"><a href="{{route('product_detail',$related->id)}}">{{$related->name}}</a></h3>
                            </div>
                            <div class="modal_price mb-10" style="margin-top: 10px;">
                                @if($related->promotion_price==0)
                                <span class="new_price">{{number_format($related->unit_price,0," ",".")}} ₫</span>
                                @else
                                <span class="new_price">{{number_format($related->promotion_price,0," ",".")}} ₫</span>
                                <span class="old_price">{{number_format($related->unit_price,0," ",".")}} ₫</span>
                                @endif

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--new product area start-->

        <div class="space40">&nbsp;</div>

    </div>
    <!--pos page inner end-->
</div>
</div>
<!--pos page end-->
<script>
    let imageMain = document.getElementById('image-main');
    let imageDetail = document.querySelectorAll('.image-detail');
    imageDetail.forEach(function(btn) {
        btn.addEventListener('mouseover', function() {
            let src = this.src;
            imageMain.src = src;
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function AddCart(id) {
        // $('#disabled_add').addClass('disabled');
        let id_size = $('.size-selected').val();
        if (id_size != '') {
            $.ajax({
                url: "{{url('/add-to-cart')}}" + '/' +id,
                type: 'GET',
                data: {
                    "id_size": id_size
                }
            }).done(function(response) {
                console.log(response);
                $('#total_qty_header').html(response.totalQty);
                $('#total_price_header').html(Number(response.totalPrice).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'));
                //total_qty_header
                Swal.fire({
                    icon: 'success',
                    title: 'Đã thêm vào giỏ hàng',
                    showConfirmButton: false,
                    timer: 2000
                })
                //  $('#disabled_add').removeClass('disabled');
            })
        }else{
            Swal.fire({
					icon: 'error',
					title: 'Vui lòng chọn size',
					showConfirmButton: false,
					timer: 2000
				})
        }

    }
</script>
@endsection

