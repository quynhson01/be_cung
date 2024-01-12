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
				<div class="panel-heading">Quản lý kho hàng</div>
				<div class="panel-body">
					@include('note.success')
					@if(Session::has('danger'))
					<div class="alert alert-danger">{{Session::get('danger')}}.</div>
					@endif
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
										<th width="6%">Mã SP</th>
										<th width="18%">Tên Sản phẩm</th>
										<th width="8%">Kích thước</th>
										<th width="12%">Số lượng tồn</th>
										<th width="12%">Số lượng đã bán</th>
										<th width="12%">Vốn tồn kho</th>
										<th width="12%">Giá trị tồn kho</th>
										<th width="10%">Nhập kích thước</th>
										<th width="10%">Nhập kho</th>
									</tr>
								</thead>
								<tbody>
									@foreach($stores as $store)
									<tr>
										<td>{{$store->id}}</td>
										<td>{{$store->name}}</td>
										<td>
											@foreach($store->size as $size)
											{{$size->size}},
											@endforeach
										</td>
										<td>{{number_format($store->quantity,0," ",".")}}</td>
										<td>{{number_format($store->sold_quantity,0," ",".")}}</td>
										<td>{{number_format($store->quantity*$store->original_price,0," ",".")}}</td>
										<td>{{number_format($store->quantity*$store->unit_price,0," ",".")}}</td>
										<td>
											<a data-url="{{route('add_size',$store->id)}}" type="button" class="btn btn-success btn-edit"><i class="fa fa-plus" aria-hidden="true"></i></a><br><br>
										</td>
										<td>
											<a href="{{route('add_store',$store->id)}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
<!-- cập nhật giá và số lượng -->
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="{{route('update_size')}}" id="form-edit" method="POST" role="form">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="id" id="id" value="" />
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLongTitle">Thêm kích thước (loại) sản phẩm<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
							<span aria-hidden="true">&times;</span>
						</a></h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Kích thước</label>
						<input type="text" class="form-control" autocomplete="off" name="size" list="size" required/>
						<datalist id="size">
							<option>S</option>
							<option>M</option>
							<option>L</option>
							<option>XL</option>
							<option>XXL</option>
						</datalist>
						@error('size')
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
@endsection
@section('script')
<script type="text/javascript">
    var table = $('#example').DataTable({
		"paging": true,
		"info": false,
        "order": [[0, 'desc']],
	});

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
				$('#id').val(response.data.id);
				$('#modal-edit').modal('show');
			},

		})
	})
</script>
@endsection
