@if(count($errors)>0)
	<div class="alert alert-danger">
		@foreach($errors->all() as $err)
			{{$err}}. 
		@endforeach
	</div>
@endif