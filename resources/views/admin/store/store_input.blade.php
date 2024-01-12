@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row" style="margin-bottom: 15px;">
		<ol class="breadcrumb">
			<li><a href="{{route('admin_index')}}">
					<em class="fa fa-home"></em>
				</a></li>
			<li class="active">Nhập kho</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">

			<div class="panel panel-primary">
				<div class="panel-heading">Nhập kho</div>
				<div class="panel-body">
					@include('note.success')
					@if(count($errors)>0)
					<div class="alert alert-danger">
						@foreach($errors->all() as $err)
						{{$err}}.
						@endforeach
					</div>
					@endif
					<div class="bootstrap-table">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th width="5%">STT</th>
										<th width="40%">Tên Sản phẩm</th>
										<th width="15%">Kích thước</th>
										<th width="15%">Số lượng tồn</th>
										<th width="15%">Nhập số lượng</th>
										<th width="10%">Thao tác</th>
									</tr>
								</thead>
								<tbody>
								<?php $i=1 ?>
									@foreach($sizes as $size)
									<tr>
										<td>{{$i++}}</td>
										<td>{{$size->product->name}}</td>
										<td>{{$size->size}}</td>
										<td>{{$size->quantity}}</td>
										<td>
											<a data-url="{{route('add_quantity',$size->id)}}" type="button" class="btn btn-success btn-edit"><i class="fa fa-plus" aria-hidden="true"></i></a>
										</td>
										<td>
											<a data-url="{{ route('edit_size',$size->id) }}" type="button" class="btn btn-primary btn-edit1"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{ route('delete_size',$size->id) }}" ​ type="button" class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('.btn-edit1').click(function(e) {
		e.preventDefault();
		var url = $(this).attr('data-url');
		$.ajax({
			//phương thức get
			type: 'get',
			url: url,
			success: function(response) {
				//đưa dữ liệu controller gửi về điền vào input trong form edit.
				$('#size-edit1').val(response.data.size);
				$('#id1').val(response.data.id);
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#modal-edit1').modal('show');
			},
		})
	})
</script>

<!--ProductType-->
<div class="modal fade" id="modal-edit1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('update_sizes')}}" method="POST" role="form">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="id" id="id1" value="" />
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLongTitle">Cập nhật kích thước<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
							<span aria-hidden="true">&times;</span>
						</a></h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Kích thước</label>
						<input type="text" class="form-control" autocomplete="off" name="size" list="size" id="size-edit1" required/>
						<datalist id="size">
							<option>5kg</option>
							<option>10kg</option>
							<option>15kg</option>
							<option>20kg</option>
							<option>25kg</option>
							<option>30kg</option>
							<option>1kg</option>
							<option>2kg</option>
							<option>Lớn</option>
							<option>Nhỏ</option>
							<option>Dài</option>
							<option>Ngắn</option>
							<option>Đực</option>
							<option>Cái</option>
						</datalist>
						@error('size')
						<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
						@enderror
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-primary">Cập nhật</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- cập nhật giá và số lượng -->
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="{{route('update_quantity')}}" id="form-edit" method="POST" role="form">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="id" id="id" value="" />
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLongTitle">Thêm số lượng sản phẩm<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
							<span aria-hidden="true">&times;</span>
						</a></h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Thêm số lượng</label>
						<input min="0" type="number" name="quantity" class="form-control" required>
						@error('quantity')
						<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
						@enderror
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-primary">Thêm</button>

				</div>
			</form>
		</div>
	</div>
</div>
<!--script-->

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('.btn-edit').click(function(e) {
		e.preventDefault();
		var url = $(this).attr('data-url');
		$.ajax({
			type: 'get',
			url: url,
			success: function(response) {
				$('#id').val(response.quantity.id);
				$('#modal-edit').modal('show');
			},

		})
	})
</script>
@endsection