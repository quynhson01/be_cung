@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row" style="margin-bottom: 15px;">
		<ol class="breadcrumb">
			<li><a href="{{route('admin_index')}}">
					<em class="fa fa-home"></em>
				</a></li>
			<li class="active">Thành viên</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">

			<div class="panel panel-primary">
				<div class="panel-heading">Danh sách thành viên</div>
				<div class="panel-body">
					@include('note.fail')
					@include('note.success')
					<div class="container" style="margin-left: 70%;">
						<form class="form-inline" method="POST" action="{{route('search_user')}}">
							@csrf
							<div class="form-group">
								<label for="pwd">Tìm kiếm</label>
								<input type="text" autocomplete="off" name="search" class="form-control">
							</div>
							<button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>
					</div>
					<div class="bootstrap-table">
						<div class="table-responsive">
							<table class="table table-bordered" style="margin-top:10px;">
								<thead>
									<tr class="bg-primary">
										<th width="6%">Mã TV</th>
										<th width="15%">Họ tên</th>
										<th width="20%">Email</th>
										<th width="25%">Địa chị</th>
										<th width="12%">Số điện thoại</th>
										<th width="14%">Quyền</th>
										<th width="8%">Thao tác</th>
									</tr>
								</thead>
								<tbody id="myTable">
									@foreach($users as $user)
									<tr>
										<td>{{$user->id}}</td>
										<td>{{$user->full_name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->address}}</td>
										<td>{{$user->phone}}</td>
										<td>
											@if($user->level == 1)
											<div class="btn-group">
												<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" style="background: #777;color: #FFFFFF;width: 127px;">
													Quản trị viên
													{{-- <span class="caret"></span> --}}
												</button>
												{{-- <ul class="dropdown-menu" style="min-width: 127px;box-shadow:none;border:none;border:none;box-shadow:none;margin:0px 0 0;padding: 2px 0;">
													<li style="width: 127px;">
														<a href="{{route('user_active',$user->id)}}" class="btn btn-xs" style="background: #30a5ff;color: #FFFFFF;font-size: 14px;">Khách hàng</a>
													</li>
												</ul> --}}
											</div>
											@else
											<div class="btn-group">
												<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" style="background: #30a5ff;color: #FFFFFF;width: 127px;">
													Khách hàng
													{{-- <span class="caret"></span> --}}
												</button>
												{{-- <ul class="dropdown-menu" style="min-width: 127px;box-shadow:none;border:none;border:none;box-shadow:none;margin:0px 0 0;padding: 2px 0;">
													<li style="width: 127px;">
														<a href="{{route('admin_active',$user->id)}}" class="btn btn-xs" style="background: #777;color: #FFFFFF;font-size: 14px;">Quản trị viên</a>
													</li>
												</ul> --}}
											</div>
											@endif
										</td>
										<td>
                                            @if($user->level == 0)
											<a onclick="return confirm('Bạn có chắc chắn muốn xóa')" href="{{route('user_delete',$user->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            @endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<div class="row">{{$users->links('vendor.pagination.bootstrap-4')}}</div>
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
@endsection
