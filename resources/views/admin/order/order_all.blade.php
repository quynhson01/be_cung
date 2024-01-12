@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row" style="margin-bottom: 15px;">
		<ol class="breadcrumb">
			<li><a href="{{route('admin_index')}}">
					<em class="fa fa-home"></em>
				</a></li>
			<li class="active">Tất cả đơn hàng</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách tất cả đơn hàng</div>
				<div class="panel-body">

					<div class="bootstrap-table">
						<div class="table-responsive">
							@include('note.success')
							@if(Session::has('error'))
                            <div style="font-size: 18px;" class="alert alert-danger">{{Session::get('error')}}.</div>
                            @endif
							<div class="btn-group">
								<div class="btn-group" style="margin-bottom: 10px;">
									<button style="border-radius: 4px;" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
										Đơn hàng <span class="caret"></span></button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="{{route('order_received')}}">Đơn hàng tiếp nhận</a></li>
										<li><a href="{{route('order_moved')}}">Đơn hàng đang giao</a></li>
										<li><a href="{{route('order_complete')}}">Đang hàng đã giao</a></li>
										<li><a href="{{route('order_cancel')}}">Đơn hàng thất bại</a></li>
										<li><a href="{{route('order_all')}}">Tất cả đơn hàng</a></li>
									</ul>
								</div>
								<div class="container" style="margin-left: 25%;">
									<form class="form-inline" method="POST" action="{{route('all_search')}}">
										@csrf
										<div class="form-group">
											<label for="email">Từ:</label>
											<input type="date" name="from" class="form-control">
										</div>
										<div class="form-group">
											<label for="pwd">Đến:</label>
											<input type="date" name="to" class="form-control">
										</div>
										<button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
									</form>
								</div>
							</div>
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th width="9%">Mã ĐH</th>
										<th width="33%">Thông tin khách hàng</th>
										<th>Họ tên</th>
										<th>Email</th>
										<th>Giới tính</th>
										<th>Địa chỉ</th>
										<th>Số điện thoại</th>
										<th>Chi tiết</th>
										<th width="15%">Tổng tiền (đồng)</th>
										<th width="14%">Ngày và giờ</th>
										<th width="9%">Chi tiết</th>
										<th width="10%">Trạng thái</th>
										<th width="10%">Thao tác</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($orders as $order)
									<tr>
										<td>{{$order->id}}</td>
										<td>
											<li>Họ tên: {{$order->name}}</li>
											@if($order->gender==1)
											<li>Giới tính: Nam</li>
											@else
											<li>Giới tính: Nữ</li>
											@endif
											<li>Email: {{$order->email}}</li>
											<li>Địa chỉ: {{$order->address}}</li>
											<li>SĐT: {{$order->phone_number}}</li>
										</td>
										<td>{{$order->name}}</td>
										<td>{{$order->email}}</td>
										<td>@if($order->gender==1) Nam @else Nữ @endif</td>
										<td>{{$order->address}}</td>
										<td>{{$order->phone_number}}</td>
										<td>
											<table class="table table-striped">
												<thead>
													<tr class="bg-primary">
														<th width="8%">Mã SP</th>
														<th width="20%">Tên sản phẩm</th>
														<th width="15%">Hình ảnh</th>
														<th width="12%">Kích thước</th>
														<th width="15%">Số lượng</th>
														<th width="15%">Giá</th>
														<th width="15%">Thành tiền</th>
													</tr>
												</thead>
												<tbody id="myTable">
													@foreach($order->billdetail as $order_detail)

													<tr class="out_product">
														<td>{{$order_detail->products->id}}</td>
														<td>{{$order_detail->products->name}}</td>
														<td>
															<img width="100px" src="{{asset('frontend/image/product/'.$order_detail->products->image)}}" class="thumbnail">
														</td>
														<td>{{$order_detail->size}}</td>
														<td>
														<div>{{$order_detail->quantity}}</div><br>
														@if($order_detail->quantity > $order_detail->sizes->quantity)
														<div><a style="font-size: 14px;" class="label label-danger">Kho không đủ</a></div>
														@endif
														</td>


														<td>
															@if($order_detail->products->promotion_price==0)
															{{number_format($order_detail->products->unit_price,0," ",".")}} đ
															@else
															{{number_format($order_detail->products->promotion_price,0," ",".")}} đ
															@endif
														</td>
														<td>
															@if($order_detail->products->promotion_price==0)
															{{number_format($order_detail->products->unit_price*$order_detail->quantity,0," ",".")}} đ
															@else
															{{number_format($order_detail->products->promotion_price*$order_detail->quantity,0," ",".")}} đ
															@endif
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</td>
										<td>
											{{number_format($order->total,0," ",".")}}
										</td>
										<td>{{$order->created_at->format('d/m/Y H:i:s')}}</td>
										<td> </td>

										<td>
											@if($order->status == 0)
											<div class="btn-group">
												<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" style="background: #777;color: #FFFFFF;width: 127px;">
													Đang tiếp nhận
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" style="min-width: 127px;box-shadow:none;border:none;border:none;box-shadow:none;margin:0px 0 0;padding: 2px 0;">
													<li style="width: 127px;">
														<a href="{{route('moved_none_all',$order->id)}}" class="btn btn-xs" style="background: #30a5ff;color: #FFFFFF;font-size: 14px;">Đang giao</a>
													</li>
													<li style="height:2px;"></li>
													<li style="width: 127px;">
														<a href="{{route('complete_none_all',$order->id)}}" class="btn btn-xs" style="background: #5cb85c;color: #FFFFFF;font-size: 14px;">Đã giao</a>
													</li>
													<li style="height:2px;"></li>
													<li style="width: 127px;">
														<a href="{{route('cancelactive_all',$order->id)}}" class="btn btn-xs" style="background: #ea3a3c;color: #FFFFFF;font-size: 14px;">Thất bại</a>
													</li>
												</ul>
											</div>
											@elseif($order->status == 1)
											<div class="btn-group">
												<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" style="background: #30a5ff;color: #FFFFFF;width: 127px;">
													Đang giao
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" style="min-width: 127px;box-shadow:none;border:none;border:none;box-shadow:none;margin:0px 0 0;padding: 2px 0;">
													<li style="width: 127px;">
														<a href="{{route('receive_none_all',$order->id)}}" class="btn btn-xs" style="background: #777;color: #FFFFFF;font-size: 14px;">Đang tiếp nhận</a>
													</li>
													<li style="height:2px;"></li>
													<li style="width: 127px;">
														<a href="{{route('complete_none_all',$order->id)}}" class="btn btn-xs" style="background: #5cb85c;color: #FFFFFF;font-size: 14px;">Đã giao</a>
													</li>
													<li style="height:2px;"></li>
													<li style="width: 127px;">
														<a href="{{route('cancelactive_all',$order->id)}}" class="btn btn-xs" style="background: #ea3a3c;color: #FFFFFF;font-size: 14px;">Thất bại</a>
													</li>

												</ul>
											</div>
											@elseif($order->status == 2)
											<div class="btn-group">
												<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" style="background: #5cb85c;color: #FFFFFF;width: 127px;">
													Đã giao
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" style="min-width: 127px;box-shadow:none;border:none;border:none;box-shadow:none;margin:0px 0 0;padding: 2px 0;">
													<li style="width: 127px;">
														<a href="{{route('receive_none_all',$order->id)}}" class="btn btn-xs" style="background: #777;color: #FFFFFF;font-size: 14px;">Đang tiếp nhận</a>
													</li>
													<li style="height:2px;"></li>
													<li style="width: 127px;">
														<a href="{{route('moved_none_all',$order->id)}}" class="btn btn-xs" style="background: #30a5ff;color: #FFFFFF;font-size: 14px;">Đang giao</a>
													</li>
													<li style="height:2px;"></li>
													<li style="width: 127px;">
														<a href="{{route('cancelactive_all',$order->id)}}" class="btn btn-xs" style="background: #ea3a3c;color: #FFFFFF;font-size: 14px;">Thất bại</a>
													</li>

												</ul>
											</div>
											@else
											<div class="btn-group">
												<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" style="background: #ea3a3c;color: #FFFFFF;width: 127px;">
													Thất bại
													<span class="caret"></span>
												</button>
												<ul class="dropdown-menu" style="min-width: 127px;box-shadow:none;border:none;border:none;box-shadow:none;margin:0px 0 0;padding: 2px 0;">
													<li style="width: 127px;">
														<a href="{{route('receivedactive_all',$order->id)}}" class="btn btn-xs" style="background: #777;color: #FFFFFF;font-size: 14px;">Đang tiếp nhận</a>
													</li>
													<li style="height:2px;"></li>
													<li style="width: 127px;">
														<a href="{{route('movedactive_all',$order->id)}}" class="btn btn-xs" style="background: #30a5ff;color: #FFFFFF;font-size: 14px;">Đang giao</a>
													</li>
													<li style="height:2px;"></li>
													<li style="width: 127px;">
														<a href="{{route('completeactive_all',$order->id)}}" class="btn btn-xs" style="background: #5cb85c;color: #FFFFFF;font-size: 14px;">Đã giao</a>
													</li>
												</ul>
											</div>
											@endif
										</td>
										<td>
										<a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{route('delete_cancel',$order->id)}}" ​ type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
										</td>
										<td>{{$order->note}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
</div>
<!--/.main-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="width:auto">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title" id="myModalLabel">Chi tiết đơn hàng</h3>
			</div>
			<div class="modal-body">
				<div class="showBill"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
			</div>

		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	var table = $('#example').DataTable({
		"paging": true,
		"info": false,
        "order": [[0, 'desc']],
		// hiding columns via datatable column.visivle API
		"columnDefs": [{
			"targets": [2, 3, 4, 5, 6, 7, 13],
			"visible": false
		}, {
			// adding a more info button at the end
			"targets": -4,
			"data": null,
			"defaultContent": "<button title='Xem chi tiết' class='btn btn-info btn1' ><i class='fa fa-eye'></i></button>",
		}]
	});

	$('#example tbody').on('click', '.btn1', function() {
		var data = table.row($(this).parents('tr')).data(); // getting target row data
		$('.showBill').html(
			// Adding and structuring the full data
			'<table style="font-size: 16px;" width="100%"><h3 class="text-center" style="color: #337ab7;">Thông tin khách hàng</h3><tbody><br><tr><th style="padding: 6px;">Tên Khách Hàng:</th><td style="padding: 6px;">' + data[2] +
			'</td></tr><tr><th style="padding: 6px;">Giới tính:</th><td style="padding: 6px;">' + data[4] + '</td></tr><tr><th style="padding: 6px;">Email:</th><td style="padding: 6px;">' + data[3] +
			'</td></tr><tr><th style="padding: 6px;">Địa chỉ:</th><td style="padding: 6px;">' + data[5] + '</td></tr><tr><th style="padding: 6px;">Số điện thoại:</th><td style="padding: 6px;">' + data[6] +
			'</td></tr><tr><th style="padding: 6px;">Ngày đặt hàng:</th><td style="padding: 6px;">' + data[9] + '</td></tr><tr><th style="padding: 6px;">Mã đơn hàng:</th><td style="padding: 6px;">' + data[0] +
			'</td></tr><tr><th style="padding: 6px;">Ghi chú:</th><td style="padding: 6px;">' + data[13] + '</td></tr></tbody></table><br>' +
			'<table class="table table-bordered table-hover dataTable"><tr role="row"><th class="sorting_asc text-center" style="background: #f1f4f7;"><h4>Thông tin đơn hàng</h4></th></tr><tbody><tr style="background: #fff;"><td>' + data[7] +
			'</td></tr><tr><td style="background: #f1f4f7;"><b style="font-size:18px">Tổng tiền :</b><b style="font-size:18px" class="text-red pull-right">' + data[8] + ' Đồng</b></td></tr></table>'

		);
		$('#myModal').modal('show'); // calling the bootstrap modal
	});
</script>
@stop
