@extends('admin.layout.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row" style="margin-bottom: 15px;">
		<ol class="breadcrumb">
			<li><a href="{{route('admin_index')}}">
					<em class="fa fa-home"></em>
				</a></li>
			<li class="active">Sản phẩm</li>
			<li class="active">Cập nhật</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Cập nhật sản phẩm</div>
				@include('note.fail')
				<div class="panel-body">
					<form action="{{route('product_edit',$product->id)}}" method="post" enctype="multipart/form-data" style="width: 950px;">
						@csrf
						<div class="row" style="margin-bottom:25px">
							<div class="col-xs-8">
								<div class="form-group">
									<label>Tên sản phẩm</label>
									<input type="text" name="name" class="form-control" value="{{$product->name}}">
									@error('name')
									<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
									@enderror
								</div>

								<div class="form-group">
									<label>Loại sản phẩm</label>
									<select name="type" class="form-control">
										<option value="{{$product->producttype->id}}">--- {{$product->producttype->name}} ---</option>
										@foreach($product_type as $type)
										<option value="{{$type->id}}">{{$type->name}}</option>
										@endforeach
									</select>
									@error('type')
									<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
									@enderror
								</div>

								<div class="form-group">
									<label>Thương hiệu</label>
									<select name="supplier" class="form-control">
										<option value="{{$product->supplier->id}}">--- {{$product->supplier->name}} ---</option>
										@foreach($brands as $prand)
										<option value="{{$prand->id}}">{{$prand->name}}</option>
										@endforeach
									</select>
									@error('publisher')
									<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
									@enderror
								</div>

								<div class="form-group">
									<label>Mô tả ngắn</label><br>
									<textarea id="content" name="description">
									{{$product->description}}
									</textarea>
									@error('description')
									<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
									@enderror
									<script type="text/javascript">
										CKEDITOR.replace('content', {
											filebrowserBrowseUrl: 'http://127.0.0.1/shopthoitrang/public/ckfinder/ckfinder.html',
											filebrowserImageBrowseUrl: 'http://127.0.0.1/shopthoitrang/public/ckfinder/ckfinder.html?Type=Images',
											filebrowserUploadUrl: 'http://127.0.0.1/shopthoitrang/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
											filebrowserImageUploadUrl: 'http://127.0.0.1/shopthoitrang/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
										});
									</script>

								</div><br>

								<div class="form-group">
									<label>Mô tả chi tiết</label><br>
									<textarea id="content1" name="long_description">
									{{$product->long_description}}
									</textarea>
									@error('description')
									<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
									@enderror
									<script type="text/javascript">
										CKEDITOR.replace('content1', {
											filebrowserBrowseUrl: 'http://127.0.0.1/shopthoitrang/public/ckfinder/ckfinder.html',
											filebrowserImageBrowseUrl: 'http://127.0.0.1/shopthoitrang/public/ckfinder/ckfinder.html?Type=Images',
											filebrowserUploadUrl: 'http://127.0.0.1/shopthoitrang/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
											filebrowserImageUploadUrl: 'http://127.0.0.1/shopthoitrang/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
										});
									</script>

								</div><br>
							</div>
							<div class="col-xs-4">
								<div class="form-group">
									<label>Giá nhập</label>
									<input type="number" name="original" class="form-control" value="{{$product->original_price}}">
									@error('original')
									<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
									@enderror
								</div>
								<div class="form-group">
									<label>Giá bán</label>
									<input type="number" name="price" class="form-control" value="{{$product->unit_price}}">
									@error('price')
									<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
									@enderror
								</div>
								<div class="form-group">
									<label>Giá khuyến mãi</label>
									<input type="number" name="promotion" class="form-control" value="{{$product->promotion_price}}">
									@error('promotion')
									<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
									@enderror
								</div>
								<div class="form-group">
									<label>Ảnh sản phẩm</label>
									<input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
									<img id="avatar" class="thumbnail" width="200px" src="{{asset('/frontend/image/product/'.$product->image)}}">
									@error('img')
									<div style="color: #f02849; font-size: 16px;">{{ $message }}.</div>
									@enderror
								</div>

								<div class="form-group">
									<label>Ảnh chi tiết</label>
									<div>
										@foreach($product->images as $image)
										<img style="margin-top: 5px;" width="90px" src="{{asset('/frontend/image/products/'.$image)}}" width="100px;" height="100px;">
										@endforeach
									</div><br>
									<input type="file" multiple="multiple" name="imgs[]" id="imgs" />
									<div id="myImg" style="margin-top: 10px;">
									</div>
								</div>
							</div>
						</div>
						<center><input type="submit" name="submit" value="Cập nhật" class="btn btn-primary">
							<a onclick="quaylai()" class="btn btn-danger">Hủy bỏ</a>
						</center>
					</form>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->
</div>
<!--/.main-->
<script type="text/javascript">
	$("#imgs").change(function() {

		if (this.files && this.files[0]) {
			for (var i = 0; i < this.files.length; i++) {
				var reader_detail = new FileReader();
				reader_detail.onload = imageIsLoaded;
				reader_detail.readAsDataURL(this.files[i]);
			}
		}
	});

	function imageIsLoaded(e) {
		var output = '<img style="margin-top: 5px;margin-left: 5px;" width="90px" height="90px" src=' + e.target.result + '>';
		$("#myImg ").append(output);

	};
</script>

@endsection
