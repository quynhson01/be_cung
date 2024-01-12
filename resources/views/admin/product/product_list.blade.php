@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row" style="margin-bottom: 15px;">
		<ol class="breadcrumb">
			<li><a href="{{route('admin_index')}}">
					<em class="fa fa-home"></em>
				</a></li>
			<li class="active">Sản phẩm</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">

			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách sản phẩm</div>
				<div class="panel-body">
					@include('note.success')
					<a href="{{route('product_add')}}" style="margin-bottom: 10px;" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>Thêm mới</a>
					<div class="bootstrap-table">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th width="5%">Mã SP</th>
										<th width="15%">Tên Sản phẩm</th>
										<th width="15%">Loại sản phẩm</th>
										<th width="12%">Hình ảnh</th>
										<th width="12%">Giá(đồng)</th>
										<th width="12%">Giá khuyến mãi(đồng)</th>
										<th width="6%">Nổi bật</th>
										<th width="7%">Trạng thái</th>
										<th width="6%">Chi tiết</th>
										<th>tt</th>
										<th>1</th>
										<th>2</th>
										<th>3</th>
										<th>4</th>
										<th width="10%">Thao tác</th>

									</tr>
								</thead>
								<tbody>
									@foreach($products as $product)
									<tr>
										<td>{{$product->id}}</td>
										<td>{{$product->name}}</td>
										<td>{{$product->ProductType->name}}</td>
										<td>
											<img width="130px" height="100px" src="{{asset('frontend/image/product/'.$product->image)}}" class="thumbnail">
										</td>
										<td>{{number_format($product->unit_price,0," ",".")}}</td>
										<td>{{number_format($product->promotion_price,0," ",".")}}</td>

										<td id="no_ok-{{$product->id}}">
											@if($product->highlights==1)
											<a onclick="No('{{$product->id}}')" style="font-size: 25px;" class="btn"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
											@else
											<a onclick="Ok('{{$product->id}}')" style="font-size: 25px;" class="btn"><i class="fa fa-square-o" aria-hidden="true"></i></a>
											@endif
										</td>
										<td id="off_on-{{$product->id}}">
											@if($product->status==1)
											<a onclick="Off('{{$product->id}}')" style="font-size: 25px;" class="btn"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
											@else
											<a onclick="On('{{$product->id}}')" style="font-size: 25px;" class="btn"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
											@endif
										</td>
										<td> </td>
										<td>
											<table class="table table-striped">
												<thead>
													<tr class="bg-primary">
														<th width="15%">Ảnh đại diện</th>
														<th width="35%">Ảnh chi tiết</th>
														<th width="50%">Mô tả sản phẩm</th>

													</tr>
												</thead>
												<tbody id="myTable">
													<tr>
														<td>
															<img width="80px" src="{{asset('frontend/image/product/'.$product->image)}}" class="thumbnail">
														</td>
														<td>
															@foreach($product->images as $image)
															<img style="margin-top: 5px;" width="50px" src="{{asset('/frontend/image/products/'.$image)}}">
															@endforeach
														</td>
														<td>{!!$product->description!!}</td>

													</tr>
												</tbody>
											</table>
										</td>
										<td>{{number_format($product->original_price,0," ",".")}}</td>
										<td>{{$product->quantity}}</td>
										<td>{{$product->supplier->name}}</td>
										<td>{{$product->user->full_name}}</td>

										<td>
											<a href="{{route('product_edit',$product->id)}}" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{route('product_delete',$product->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
										</td>

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
<!-- chi tiết sản phẩm -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="width:auto">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title" id="myModalLabel">Chi tiết sản phẩm</h3>
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
<!--script-->
<script>

</script>
@endsection
@section('script')
<script type="text/javascript">
	var table = $('#example').DataTable({
		"paging": true,
		"info": false,
        "order": [[0, 'desc']],
		// hiding columns via datatable column.visivle API
		"columnDefs": [{
			"targets": [9,10,11,12,13],
			"visible": false
		}, {
			// adding a more info button at the end
			"targets": -7,
			"data": null,
			"defaultContent": "<button title='Xem chi tiết' class='btn btn-info btn1' ><i class='fa fa-eye'></i></button>",
		}]
	});

	$('#example tbody').on('click', '.btn1', function() {
		var data = table.row($(this).parents('tr')).data(); // getting target row data
		$('.showBill').html(
			// Adding and structuring the full data
			'<table style="font-size: 16px;" width="100%"><h3 class="text-center" style="color: #337ab7;">Chi tiết sản phẩm</h3><tbody><br><tr><th style="padding: 6px;">Mã sản phẩm:</th><td style="padding: 6px;">' + data[0] +
			'</td></tr><tr><th style="padding: 6px;">Tên sản phẩm:</th><td style="padding: 6px;">' + data[1] +
			'</td></tr><tr><th style="padding: 6px;">Loại sản phẩm:</th><td style="padding: 6px;">' + data[2] +
			'</td></tr><tr><th style="padding: 6px;">Thương hiệu:</th><td style="padding: 6px;">' + data[12] +
			'</td></tr><tr><th style="padding: 6px;">Giá gốc:</th><td style="padding: 6px;">' + data[10] +
			' đồng</td></tr><tr><th style="padding: 6px;">Giá bán:</th><td style="padding: 6px;">' + data[4] +
			' đồng</td></tr><tr><th style="padding: 6px;">Giá khuyến mãi:</th><td style="padding: 6px;">' + data[5] +
			' đồng</td></tr><tr><th style="padding: 6px;">Số lượng trong kho:</th><td style="padding: 6px;">' + data[11] +
			'</td></tr><tr><th style="padding: 6px;">Người tạo:</th><td style="padding: 6px;">' + data[13] +
			'</td></tr></tbody></table><br>' +
			'<table class="table table-bordered table-hover dataTable"><tr role="row"><th class="sorting_asc text-center" style="background: #f1f4f7;"><h4>Hình ảnh và mô tả sản phẩm</h4></th></tr><tbody><tr style="background: #fff;"><td>' + data[9] +
			'</td></tr></table>'

		);
		$('#myModal').modal('show'); // calling the bootstrap modal
	});
</script>
<script>
    function Off(id) {
        $.ajax({
            url: '/admin/products/off/' + id,
            type: 'GET',
            success: function(response) {
				console.log(response);
                let product = JSON.parse(response)['off'];
                $('#off_on-' +product['id']).html('<a onclick="On('+product['id']+')" style="font-size: 25px;" class="btn"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>');
            }
        })
    }
</script>
<script>
    function On(id) {
        $.ajax({
            url: '/admin/products/on/' + id,
            type: 'GET',
            success: function(response) {
				console.log(response);
                let product = JSON.parse(response)['on'];
                $('#off_on-'+product['id']).html('<a onclick="Off('+product['id']+')" style="font-size: 25px;" class="btn"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>');

            }
        })
    }
</script>
<script>
    function No(id) {
        $.ajax({
            url: '/admin/products/no/' + id,
            type: 'GET',
            success: function(response) {
				console.log(response);
                let product_no_ok = JSON.parse(response)['no'];
                $('#no_ok-' +product_no_ok['id']).html('<a onclick="Ok('+product_no_ok['id']+')" style="font-size: 25px;" class="btn"><i class="fa fa-square-o" aria-hidden="true"></i></a>');
            }
        })
    }
</script>
<script>
    function Ok(id) {
        $.ajax({
            url: '/admin/products/ok/' + id,
            type: 'GET',
            success: function(response) {
				console.log(response);
                let product_no_ok = JSON.parse(response)['ok'];
                $('#no_ok-'+product_no_ok['id']).html('<a onclick="No('+product_no_ok['id']+')" style="font-size: 25px;" class="btn"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>');

            }
        })
    }
</script>
@stop
