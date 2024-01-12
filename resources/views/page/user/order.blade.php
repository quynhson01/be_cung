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
								<li>Danh sách đơn hàng</li>
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
							<table class="table table-striped" style="font-family: Arial, Helvetica, sans-serif;">
								<thead>
									<tr class="bg-muted" style="font-size: 18px;">
										<th width="5%">ID</th>
										<th width="32%">Thông tin</th>
										<th width="12%">Tổng tiền</th>
										<th width="12%">Ngày tạo</th>
										<th width="10%">chi tiết</th>
										<th width="14%">Trạng thái</th>
									</tr>
								</thead>
								<tbody id="myTable" style="font-size: 16px;">
									@foreach($orders as $order)
									<tr>
										<td>{{$order->id}}</td>
										<td>
											<ul>
												<li>Họ tên: {{$order->name}}</li>
												@if($order->gender==1)
												<li>Giới tính: Nam</li>
												@else
												<li>Giới tính: Nữ</li>
												@endif
												<li>Email: {{$order->email}}</li>
												<li>Địa chỉ: {{$order->address}}</li>
												<li>SĐT: {{$order->phone_number}}</li>
											</ul>
										</td>
										<td>{{number_format($order->total,0," ",".")}} đ</td>
										<td>{{$order->created_at}}</td>

										<td>
											<a href="{{route('orderdetail_user',$order->id)}}" style="border-radius:20px ;" class="btn btn-primary order_detail"><i class="fa fa-eye" aria-hidden="true"></i></a>
										</td>

										<td>
											@if($order->status == 0)
											<div class="btn-group">
												<button type="button" style="background: #777;color: #FFFFFF;width: 127px;border-radius:10px ;">
													Đang tiếp nhận
												</button>
											</div>
											@elseif($order->status == 1)
											<div class="btn-group">
												<button type="button" style="background: #30a5ff;color: #FFFFFF;width: 127px;border-radius:10px ;">
													Đang giao
												</button>
											</div>
											@elseif($order->status == 2)
											<div class="btn-group">
												<button type="button" style="background: #5cb85c;color: #FFFFFF;width: 127px;border-radius:10px ;">
													Đã giao
												</button>
											</div>
											@endif
										</td>

									</tr>
									@endforeach
								</tbody>
							</table>
							<div>{{$orders->links('vendor.pagination.bootstrap-4')}}</div>
						</div>
					</div>

				</div>
		</div>
	</div>
	</section>
	<!-- End Maincontent  -->
</div>
<!--pos page inner end-->
<div id="myModal" class="modal fade" role="dialog" style="font-family: Arial, Helvetica, sans-serif;">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Chi tiết đơn hàng</h4>
			</div>
			<div class="modal-body" id="content">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
			</div>
		</div>

	</div>
</div>
<!--pos page end-->
@endsection
@section('script')
<script>
	$(function() {
		$(".order_detail").click(function(event) {
			event.preventDefault();
			let $this = $(this);
			let url = $this.attr('href');
			$("#content").html('');
			$.ajax({
				url: url,
			}).done(function(result) {
				if (result) {
					$("#content").append(result);
					$("#myModal").modal('show');
				}
			});
			
		});
	});
</script>
@stop