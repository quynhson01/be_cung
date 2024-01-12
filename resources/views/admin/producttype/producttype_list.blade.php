@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row" style="margin-bottom: 15px;">
		<ol class="breadcrumb">
			<li><a href="{{route('admin_index')}}">
					<em class="fa fa-home"></em>
				</a></li>
			<li class="active">Danh mục & Loại sản phẩm</li>
		</ol>
	</div>
	<div class="row">
		<div style="width: 50%" class="col-xs-12 col-md-5 col-lg-5">
			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách danh mục</div>
				<div class="panel-body">
					@include('note.success1')
					@if(Session::has('error1'))
					<div class="alert alert-danger">{{Session::get('error1')}}.</div>
					@endif
					<a class="btn btn-success btn-add" style="margin-bottom: 10px;" data-target="#modal-add1" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
					<div class="bootstrap-table">
						<table id="example-cate" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
                                    <th></th>
									<th width="34%">Tên danh mục</th>
									<th width="15%">Trạng thái</th>
									<th width="11%">Thao tác</th>
								</tr>
							</thead>
							<tbody>
								@foreach($menus as $menu)
								<tr>
                                    <td>{{$menu->id}}</td>
									<td>{{$menu->name}}({{count($menu->producttype)}})</td>
									<td id="off_on-{{$menu->id}}">
										@if($menu->status==1)
										<a onclick="Off('{{$menu->id}}')" style="font-size: 25px;" class="btn"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>
										@else
										<a onclick="On('{{$menu->id}}')" style="font-size: 25px;" class="btn"><i class="fa fa-toggle-off" aria-hidden="true"></i></a>
										@endif
									</td>
									<td>
										<a data-url="{{ route('menu_edit',$menu->id) }}" type="button" class="btn btn-primary btn-edit1"><i class="fa fa-pencil" aria-hidden="true"></i></a>
										<a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{ route('menu_delete',$menu->id) }}" ​ type="button" class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
		<div style="width: 50%" class="col-xs-12 col-md-7 col-lg-7">
			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách loại sản phẩm</div>
				<div class="panel-body">
					@include('note.fail')
					@include('note.success')
					@if(Session::has('error'))
					<div class="alert alert-danger">{{Session::get('error')}}.</div>
					@endif
					<a href="#" class="btn btn-success btn-add" style="margin-bottom: 10px;" data-target="#modal-add" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
					<div class="bootstrap-table">
						<table id="example-type" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
                                    <th></th>
									<th width="29%">Tên loại sản phẩm</th>
									<th width="20%">Tên danh mục</th>
									<th width="11%">Thao tác</th>
								</tr>
							</thead>
							<tbody>
								@foreach($product_types as $type)
								<tr>
                                    <td>{{$type->id}}</td>
									<td>
									{{$type->name}}({{count($type->products)}})
									</td>
									<td>{{$type->faShion->name}}</td>
									<td>
										<a data-url="{{ route('producttype_edit',$type->id) }}" type="button" class="btn btn-primary btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
										<a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{ route('producttype_delete',$type->id) }}" ​ type="button" class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
</div>
<!--/.main-->

<!--Menu-->
<div class="modal fade" id="modal-add1">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="{{route('menu_add')}}" method="POST" role="form">
				@csrf
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLongTitle">Thêm danh mục<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
							<span aria-hidden="true">&times;</span>
						</a></h3>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="">Tên danh mục</label>
						<input required style="font-size: 18px;" name="name" type="text" class="form-control" id="name-add1">
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-primary">Thêm mới</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-edit1">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="{{route('menu_update')}}" id="form-edit" method="POST" role="form">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="id" id="id1" value="" />
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLongTitle">Cập nhật danh mục<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
							<span aria-hidden="true">&times;</span>
						</a></h3>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="">Tên menu</label>
						<input style="font-size: 16px;" type="text" name="name" class="form-control" id="menu-edit1">
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

	$('.btn-edit1').click(function(e) {
		e.preventDefault();
		var url = $(this).attr('data-url');
		$.ajax({
			//phương thức get
			type: 'get',
			url: url,
			success: function(response) {
				//đưa dữ liệu controller gửi về điền vào input trong form edit.
				$('#menu-edit1').val(response.data.name);
				$('#id1').val(response.data.id);
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#modal-edit1').modal('show');
			},

		})
	})
</script>

<!--ProductType-->
<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="{{route('producttype_list')}}" method="POST" role="form">
				@csrf
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLongTitle">Thêm loại sản phẩm<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
							<span aria-hidden="true">&times;</span>
						</a></h3>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="">Tên loại sản phẩm</label>
						<input required style="font-size: 18px;" name="name" type="text" class="form-control" id="name-add" placeholder="Nhập vào họ tên">
					</div>

					<div class="form-group">
						<label for="">Thuộc danh mục</label>
						<select name="fashion" id="fashion-add" class="form-control" required="required">
							@foreach($menus as $menu)
							<option value="{{$menu->id}}">{{$menu->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
					<button type="submit" class="btn btn-primary">Thêm mới</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="{{route('producttype_update')}}" id="form-edit" method="POST" role="form">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="id" id="id" value="" />
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLongTitle">Cập nhật loại sản phẩm<a type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px;">
							<span aria-hidden="true">&times;</span>
						</a></h3>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="">Tên loại sản phẩm</label>
						<input required style="font-size: 18px;" type="text" name="name" class="form-control" id="name-edit" placeholder="Nhập vào họ tên">
					</div>

					<div class="form-group">
						<label for="">Thuộc danh mục</label>
						<select name="fashion" id="fashion-edit" class="form-control" required="required">
							@foreach($menus as $menu)
							<option value="{{$menu->id}}">{{$menu->name}}</option>
							@endforeach
						</select>
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

	$('.btn-edit').click(function(e) {
		e.preventDefault();
		var url = $(this).attr('data-url');
		$.ajax({
			//phương thức get
			type: 'get',
			url: url,
			success: function(response) {
				//đưa dữ liệu controller gửi về điền vào input trong form edit.
				$('#name-edit').val(response.data.name);
				$('#fashion-edit').val(response.data.id_fashion);
				$('#id').val(response.data.id);
				//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
				$('#modal-edit').modal('show');
			},

		})
	})
</script>
@endsection
@section('script')
<script>
	$(document).ready(function() {
		$('#example-cate').DataTable({
            "order": [[0, 'desc']],
            "columnDefs": [{
                "targets": [0],
                "visible": false
            }]
        });
        $('#example-type').DataTable({
            "order": [[0, 'desc']],
            "columnDefs": [{
                "targets": [0],
                "visible": false
            }]
        });
	});
</script>
<script>
    function Off(id) {
        $.ajax({
            url: '/admin/product-type/off/' + id,
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
            url: '/admin/product-type/on/' + id,
            type: 'GET',
            success: function(response) {
				console.log(response);
                let product = JSON.parse(response)['on'];
                $('#off_on-'+product['id']).html('<a onclick="Off('+product['id']+')" style="font-size: 25px;" class="btn"><i class="fa fa-toggle-on" aria-hidden="true"></i></a>');

            }
        })
    }
</script>
@stop
