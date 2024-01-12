@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{route('admin_index')}}">
					<em class="fa fa-home"></em>
				</a></li>
			<li class="active">Quản trị</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="panel panel-container" style="margin-top: 20px;">
		<div class="row">
			<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
				<div class="panel panel-teal panel-widget border-right">
					<div class="row no-padding"><em class="fa fa-xl fa-shopping-bag color-blue"></em>
						<div class="large">{{count($product_count)}}</div>
						<div style="color: #5a5b5d;" class="text-muted">Sản phẩm</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
				<div class="panel panel-blue panel-widget border-right">
					<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-orange"></em>
						<div class="large">{{count($order_count)}}</div>
						<div style="color: #5a5b5d;" class="text-muted">Đơn hàng</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
				<div class="panel panel-orange panel-widget border-right">
					<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
						<div class="large">{{count($user_count)}}</div>
						<div style="color: #5a5b5d;" class="text-muted">Người dùng</div>
					</div>
				</div>
			</div>
		</div>
		<!--/.row-->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background: #337ab7;color: #fff;">
					Biểu đồ thống kê doanh thu các ngày trong tháng
					<span style="background: #337ab7;color: #fff;border-radius: 5px;" class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
				</div>
				<div class="panel-body">
					<div class="canvas-wrapper" style="margin-top: 10px;">
						<div class="col-sm-12">
							<figure class="highcharts-figure">
								<div id="container" data-list-day="{{$listDay}}" data-total-revenue="{{$arrTotalRevenue}}" data-revenue-profit="{{$arrRevenueProfit}}"></div>
							</figure>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background: #337ab7;color: #fff;">
					Thống kê doanh thu
					<span style="background: #337ab7;color: #fff;border-radius: 5px;" class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
				</div>
				<div class="panel-body">
					<div class="container">
						<form class="form-inline" method="POST" action="{{route('admin_index')}}" style="margin-bottom: 10px;">
							@csrf
							<div class="form-group">
								<label for="email">Từ:</label>
								<input style="height: 30px;" type="date" name="from" class="form-control">
							</div>
							<div class="form-group">
								<label for="pwd">Đến:</label>
								<input style="height: 30px;" type="date" name="to" class="form-control">
							</div>
							<button style="padding: 4px 10px;background: #337ab7;color: #fff;" type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr class="bg-primary">
								<th width="50%">Tổng doanh thu @if($total_revenue > 0)<span>từ {{$from}} đến {{$to}}<span>@else ngày hiện tại @endif</th>
								<th width="50%">Lợi nhuận @if($revenue_profit > 0)<span> từ {{$from}} đến {{$to}}<span>@else ngày hiện tại @endif</th>
							</tr>
						</thead>
						<tbody id="myTable">
							<tr>
								<td>@if($total_revenue > 0) {{number_format($total_revenue)}} @else {{number_format($total_revenue_now)}} @endif đồng</td>
								<td>@if($total_revenue > 0) {{number_format($revenue_profit)}} @else {{number_format($revenue_profit_now)}} @endif đồng</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!--/.col-->
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading" style="background: #337ab7;color: #fff;">
					Sản phẩm bán chạy
					<span style="background: #337ab7;color: #fff;border-radius: 5px;" class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr class="bg-primary">
								<th width="5%">STT</th>
								<th width="65%">Tên sản phẩm</th>
								<th width="30%">Số lượng</th>
							</tr>
						</thead>
						<?php $i = 1 ?>
						@foreach($product_bests as $product_best)
						<tbody id="myTable">
							<tr>
								<td>{{$i++}}</td>
								<td>{{$product_best->name}}</td>
								<td>{{$product_best->sold_quantity}}</td>
							</tr>
						</tbody>
						@endforeach
					</table>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading" style="background: #337ab7;color: #fff;">
					Sản phẩm xem nhiều
					<span style="background: #337ab7;color: #fff;border-radius: 5px;" class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr class="bg-primary">
								<th width="5%">STT</th>
								<th width="65%">Tên sản phẩm</th>
								<th width="30%">Lượt xem</th>
							</tr>
						</thead>
						<?php $i = 1 ?>
						@foreach($product_views as $product_view)
						<tbody id="myTable">
							<tr>
								<td>{{$i++}}</td>
								<td>{{$product_view->name}}</td>
								<td>{{$product_view->product_views}}</td>
							</tr>
						</tbody>
						@endforeach
					</table>
				</div>
			</div>
		</div>
		<!--/.col-->
	</div>
	<!--/.row-->
</div>
<!--/.main-->
@endsection
@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript">
	let listDay = $("#container").attr('data-list-day');
	listDay = JSON.parse(listDay);

	let dataTotalRevenue = $("#container").attr('data-total-revenue');
	dataTotalRevenue = JSON.parse(dataTotalRevenue);

	let dataRevenueRrofit = $("#container").attr('data-revenue-profit');
	dataRevenueRrofit = JSON.parse(dataRevenueRrofit);

	Highcharts.chart('container', {
		chart: {
			type: 'spline'
		},
		title: {
			text: ''
		},
		subtitle: {
			text: ''
		},
		xAxis: {
			categories: listDay
		},
		credits: {
			enabled: false
		},
		yAxis: {
			title: {
				text: ''
			},
			labels: {
				formatter: function() {
					return this.value + ' VND';
				}
			}
		},
		tooltip: {
			crosshairs: true,
			shared: true
		},
		plotOptions: {
			spline: {
				marker: {
					radius: 4,
					lineColor: '#666666',
					lineWidth: 1
				}
			}
		},
		series: [{
			name: 'Lợi nhuận',
			marker: {
				symbol: 'square'
			},
			data: dataRevenueRrofit
		}, {
			name: 'Tổng doanh thu',
			marker: {
				symbol: 'diamond'
			},
			data: dataTotalRevenue
		}]
	});
</script>
@stop