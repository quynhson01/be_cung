<!DOCTYPE html>
<html>

<head>
	<base href="{{asset('backend')}}/">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quản trị</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="DataTables-1.10.23/css/dataTables.bootstrap.min.css" />
	<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand"><span></span>Quản trị</a>
				<ul class="nav navbar-top-links navbar-right">

					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown">
							<em class="fa fa-sign-out" aria-hidden="true" style="font-size: 25px;"></em>
						</a>
						<ul style="width: 10px;" class="dropdown-menu dropdown-alerts">
							<li><a href="{{route('home')}}">
									<div><em class="fa fa-home" aria-hidden="true"></em> Trang bán hàng
									</div>
								</a></li>
							<li><a href="{{route('logout')}}">
									<div><em class="fa fa-power-off" aria-hidden="true"></em> Đăng xuất
									</div>
								</a></li>

						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<div class="col-lg-4">
					<img src="\frontend\image\admin\admin.PNG" class="img-responsive" alt="">
				</div>
				<div class="col-lg-8">
					<div style="font-size: 18px;margin-top: 10px;">{{Auth::user()->full_name}}</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu" style="margin: 5px 0px;">
			<li id="home"><a href="{{route('admin_index')}}"><em class="fa fa-dashboard">&nbsp;</em>Tổng quan</a></li>
			<li><a style="background:#337ab7;color: #fff;font-size: 18px;"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Quản lý sản phẩm</a></li>
			<li id="product-type"><a href="{{route('producttype_list')}}"><i class="fa fa-list-alt" aria-hidden="true"></i> Danh mục & Loại SP</a></li>
			<li id="products"><a href="{{route('product_list')}}"><i class="fa fa-product-hunt" aria-hidden="true"></i> Sản phẩm</a></li>
			<li class="parent lia"><a data-toggle="collapse" href="#collapseExample">
					<i class="fa fa-picture-o">&nbsp;</i> Ảnh bìa <span data-toggle="collapse" href="#collapseExample" class="icon pull-right"></span>
				</a>
				<ul class="children collapse" id="collapseExample">
					<li id="slide"><a class="" href="{{route('slide_list')}}">
							<span class="fa fa-arrow-right">&nbsp;</span> Ảnh bìa
						</a></li>
					<li id="sale-banner"><a class="" href="{{route('salebanner_list')}}">
							<span class="fa fa-arrow-right">&nbsp;</span> Ảnh giảm giá
						</a></li>
				</ul>
			</li>
			<li id="supplier"><a href="{{route('supplier_list')}}"><i class="fa fa-buysellads" aria-hidden="true"></i> Thương hiệu</a></li>
			<li><a style="background:#337ab7;color: #fff;font-size: 18px;"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Quản lý bán hàng</a></li>
			<li class="parent lia"><a data-toggle="collapse" href="#sub-item-1">
					<i class="fa fa-file-text" aria-hidden="true"></i> Đơn hàng
					<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">

						<span style="background: #5cb85c;" class="label label-success pull-right">{{count($complete_order)}}</span>
						<span style="margin-right: 5px;" class="label label-info pull-right">{{count($moved_order)}}</span>
						<span style="margin-right: 5px;background: #777;color: #FFFFFF;" class="label label-primary pull-right">{{count($received_order)}}</span>
					</span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li id="order-received"><a class="" href="{{route('order_received')}}">
							<span class="fa fa-arrow-right">&nbsp;</span> Tiếp nhận<span style="margin-top: 10px;margin-right: 10px;background: #777;color: #FFFFFF;" class="label label-primary pull-right">{{count($received_order)}}</span>
						</a></li>
					<li id="order-moved"><a class="" href="{{route('order_moved')}}">
							<span class="fa fa-arrow-right">&nbsp;</span> Đang giao<span style="margin-top: 10px;margin-right: 10px;" class="label label-info pull-right">{{count($moved_order)}}</span>
						</a></li>
					<li id="order-complete"><a class="" href="{{route('order_complete')}}">
							<span class="fa fa-arrow-right">&nbsp;</span> Đã giao<span style="margin-top: 10px;margin-right: 10px;background: #5cb85c;" class="label label-success pull-right">{{count($complete_order)}}</span>
						</a></li>
				</ul>


			</li>

			<li id="store"><a href="{{route('store')}}"><i class="fa fa-archive" aria-hidden="true"></i> Kho hàng</a></li>
			<li><a style="background:#337ab7;color: #fff;font-size: 18px;"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Quản lý thành viên</a></li>
			<li id="users"><a href="{{route('user')}}"><i class="fa fa-users" aria-hidden="true"></i> Thành viên</a></li>
		</ul>
	</div>
	<!--/.sidebar-->

	@yield('content')

	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script type="text/javascript" src="DataTables-1.10.23/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="DataTables-1.10.23/js/dataTables.bootstrap.min.js"></script>
	@yield('script')
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
	<script>
		function changeImg(input) {
			//Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				//Sự kiện file đã được load vào website
				reader.onload = function(e) {
					//Thay đổi đường dẫn ảnh
					$('#avatar').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$(document).ready(function() {
			$('#avatar').click(function() {
				$('#img').click();
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			var pathname = window.location.pathname;
			var id = pathname.split('/')[2];
			$('#' + id).addClass('active');
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".lia").click(function() {
				// Clear các thẻ li có Class click cũ
				$("li").removeClass("active");
				// Thêm Class
				$(this).addClass("active");
			});
		});
	</script>
	<script>
		function quaylai() {
			history.back();
		}
	</script>
	<script>
		$(document).ready(function() {
			$('#changeemail').change(function() {
				if ($(this).is(":checked")) {
					$(".email").removeAttr('disabled');
				} else {
					$(".email").attr('disabled', '');
				}
			});
		});
	</script>
</body>

</html>
