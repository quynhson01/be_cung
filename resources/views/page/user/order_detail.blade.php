@if($order_detail)
<table class="table table-striped">
	<thead>
		<tr class="bg-default">
			<th width="5%">STT</th>
			<th width="20%">Tên sản phẩm</th>
			<th width="15%">Hình ảnh</th>
			<th width="15%">Kích thước</th>
			<th width="15%">Số lượng</th>
			<th width="15%">Giá</th>
			<th width="15%">Thành tiền</th>
		</tr>
	</thead>
	<tbody id="myTable">
		<?php $i = 1 ?>
		@foreach($order_detail as $detail)
		<tr>
			<td>{{$i++}}</td>
			<td>{{$detail->products->name}}</td>
			<td>
				<img width="80px" src="{{asset('frontend/image/product/'.$detail->products->image)}}" class="thumbnail">
			</td>
			<td>{{$detail->size}}</td>
			<td>{{$detail->quantity}}</td>
			<td>
				@if($detail->products->promotion_price==0)
				{{number_format($detail->products->unit_price,0," ",".")}} đ
				@else
				{{number_format($detail->products->promotion_price,0," ",".")}} đ
				@endif</td>
			<td>
				@if($detail->products->promotion_price==0)
				{{number_format($detail->products->unit_price*$detail->quantity,0," ",".")}} đ
				@else
				{{number_format($detail->products->promotion_price*$detail->quantity,0," ",".")}} đ
				@endif
			</td>
		</tr>

		@endforeach
	</tbody>
</table>
<div><h4>Tổng tiền: {{number_format($total->total,0," ",".")}} Đồng</h4></div>
@endif