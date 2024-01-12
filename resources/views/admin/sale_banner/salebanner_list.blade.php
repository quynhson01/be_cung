@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row" style="margin-bottom: 15px;">
		<ol class="breadcrumb">
			<li><a href="{{route('admin_index')}}">
					<em class="fa fa-home"></em>
				</a></li>
			<li class="active">Ảnh giảm giá</li>
		</ol>
	</div>
	<div class="row">
		<div style="width: 100%" class="col-xs-12 col-md-7 col-lg-7">
			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách ảnh giảm giá</div>
				<div class="panel-body">
					@include('note.fail')
					@include('note.success')
					<a class="btn btn-success btn-add" style="margin-bottom: 10px;" data-target="#modal-add" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
					<div class="bootstrap-table">
						<table id="sale_banner_table" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th></th>
									<th width="30%">Hình ảnh</th>
									<th width="40%">Tên loại sản phẩm</th>
									<th width="15%">trạng thái</th>
									<th width="15%">Thao tác</th>
								</tr>
							</thead>
							<tbody>
								@foreach($sale_banners as $sale)
								<tr>
									<td>{{$sale->id}}</td>
									<td><img width="150px" src="{{asset('/frontend/image/sale_banner/'.$sale->image)}}" width="200px;" height="100px;" class="thumbnail"></td>
									<td>{{$sale->productType->name}}</td>
									<td>
										@if($sale->status==1)
										<a style="font-size: 35px;" href="{{route('salebanner_off',$sale->id)}}" class="btn"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
										@else
										<a style="font-size: 35px;" href="{{route('salebanner_on',$sale->id)}}" class="btn"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
										@endif
									</td>
									<td>
										<a data-url="{{route('salebanner_edit',$sale->id)}}" type="button" class="btn btn-primary btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
										<a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{route('salebanner_delete',$sale->id)}}" ​ type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
</div>
<!--/.main-->
<!--Thêm mới-->
<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLongTitle">Thêm ảnh giảm giá<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
						<span aria-hidden="true">&times;</span>
					</a></h3>
			</div>
			<div class="modal-body">
				<form action="{{route('salebanner_list')}}" method="POST" role="form" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="">Thuộc loại sản phẩm</label>
						<select name="type" class="form-control">
							@foreach($types as $type)
							<option value="{{$type->id}}">{{$type->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Ảnh giảm giá</label>
						<input id="img1" type="file" name="img" class="form-control hidden" onchange="changeImg1(this)">
						<img id="avatar1" class="thumbnail" width="570px;" height="250px;" src="img/new_seo-10-512.png">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
						<button type="submit" class="btn btn-primary">Thêm mới</button>
					</div>
				</form>
			</div>

			</form>
		</div>
	</div>
</div>
<!--cập nhật-->
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{route('salebanner_update')}}" id="form-edit" method="POST" role="form" enctype="multipart/form-data">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="id" id="id" value="" />
				<div class="modal-header">
					<h3 class="modal-title">Cập nhật ảnh giảm giá<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
							<span aria-hidden="true">&times;</span>
						</a></h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Thuộc loại sản phẩm</label>
						<select name="type" id="fashion-edit" class="form-control" required="required">
							@foreach($types as $type)
							<option value="{{$type->id}}">{{$type->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Ảnh giảm giá</label>
						<input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
						<img id="avatar" class="thumbnail" width="570px" height="250px" src="img/new_seo-10-512.png">
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
<!--script-->

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	const host = window.location.origin;

	$('.btn-edit').click(function(e) {
		e.preventDefault();
		var url = $(this).attr('data-url');
		$.ajax({
			//phương thức get
			type: 'get',
			url: url,
			success: function(response) {
				console.log(response);
				//avatar
				//đưa dữ liệu controller gửi về điền vào input trong form edit.
				$('#fashion-edit').val(response.data.id_type);
				$('#id').val(response.data.id);
				$("#avatar").attr("src", host + '/frontend/image/sale_banner/' + response.data.image);
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#modal-edit').modal('show');
			},
		});

	});
</script>
<script>
	function changeImg1(input) {
		//Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			//Sự kiện file đã được load vào website
			reader.onload = function(e) {
				//Thay đổi đường dẫn ảnh
				$('#avatar1').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$(document).ready(function() {
		$('#avatar1').click(function() {
			$('#img1').click();
		});
	});
</script>
@endsection
@section('script')
<script>
    $(document).ready(function() {
		$('#sale_banner_table').DataTable({
            "order": [[0, 'desc']],
            "columnDefs": [{
                "targets": [0],
                "visible": false
            }]
        });
	});
</script>
@endsection
