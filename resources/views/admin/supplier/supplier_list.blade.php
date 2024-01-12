@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row" style="margin-bottom: 15px;">
		<ol class="breadcrumb">
			<li><a href="{{route('admin_index')}}">
					<em class="fa fa-home"></em>
				</a></li>
			<li class="active">Thương hiệu</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">

			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách thương hiệu</div>
				<div class="panel-body">
					@include('note.fail')
					@include('note.success')
					<a class="btn btn-success btn-add" style="margin-bottom: 10px;" data-target="#modal-add" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
					<div class="bootstrap-table">
						<div class="table-responsive">
							<table id="supplier_tabble" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th></th>
										<th width="15%">Logo</th>
										<th width="70%">Tên thương hiệu</th>
										<th width="15%">Thao tác</th>
									</tr>
								</thead>
								<tbody>

									@foreach($suppliers as $supplier)
									<tr>
										<td>{{$supplier->id}}</td>
										<td>
											<img width="130px" height="100px" src="{{asset('frontend/image/brands/'.$supplier->image)}}" class="thumbnail">
										</td>
										<td>{{$supplier->name}}</td>

										<td>
											<a data-url="{{route('supplier_edit',$supplier->id)}}" type="button" class="btn btn-primary btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{route('supplier_delete',$supplier->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
<!--Thêm mới-->
<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLongTitle">Thêm thương hiệu<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
						<span aria-hidden="true">&times;</span>
					</a></h3>
			</div>
			<div class="modal-body">
				<form action="{{route('supplier_add')}}" method="POST" role="form" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>Tên thương hiệu</label>
						<input required type="text" name="name" class="form-control" value="{{old('name')}}">
						@error('name')
						<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
						@enderror
					</div>

					<div class="form-group">
						<label>Logo</label>
						<input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
						<img id="avatar" class="thumbnail" width="200px" src="img/new_seo-10-512.png">
						@error('img')
						<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
						@enderror
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
			<form action="{{route('supplier_update')}}" id="form-edit" method="POST" role="form" enctype="multipart/form-data">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="id" id="id" value="" />
				<div class="modal-header">
					<h3 class="modal-title">Cập nhật thương hiệu<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
							<span aria-hidden="true">&times;</span>
						</a></h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Tên thương hiệu</label>
						<input required type="text" name="name" class="form-control" id="name-edit">
						@error('name')
						<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
						@enderror
					</div>

					<div class="form-group">
						<label>Logo</label>
						<input id="img1" type="file" name="img" class="form-control hidden" onchange="changeImg1(this)">
						<img id="avatar1" class="thumbnail" width="200px" src="img/new_seo-10-512.png">
						@error('img')
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
			type: 'get',
			url: url,
			success: function(response) {
				console.log(response);
				$('#name-edit').val(response.data.name);
				$('#link-edit').val(response.data.link);
				$("#avatar1").attr("src", host + '/frontend/image/brands/' + response.data.image);
				$('#id').val(response.data.id);
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
		$('#supplier_tabble').DataTable({
            "order": [[0, 'desc']],
            "columnDefs": [{
                "targets": [0],
                "visible": false
            }]
        });
	});
</script>
@endsection
