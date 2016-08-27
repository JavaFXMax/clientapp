@include('plugins.dash_header')

	<div class="container">
		<div class="row wrapper-menu">
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 row-wrapper">
				<h3 class="dash">Edit Order Item</h3>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 row-wrapper">
				<?php $message = Session::get('message');?>
					@if(isset($message))
						<span class='alert alert-success'>{{$message}}</span>	
					@endif	
			</div>					
			<!-- ORDER ITEM DETAILS -->
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 form-wrapper">	
			<!-- Form edit item-->		
			@if(isset($ord_details))
				@foreach($ord_details as $order)		
				<form role="form" method="POST" action="{{{ URL::to('user/edit_item') }}}">					
					<div class="form-group">
							<label for="">Item Name: </label>
							<input class="form-control" type="text" name="edit_order_item" value="{{$order->name}}" readonly="readonly">
					</div>
					<div class="form-group">
							<label for="">Quantity: </label>
							<input class="form-control" type="text" name="edit_order_quantity" value="" required >
					</div>
					<div class="form-group">
							<label for="">Price: </label>
							<input class="form-control" type="text" name="edit_order_item" value="{{$order->selling_price}}" readonly="readonly">
					</div>					
					<div class="form-group pull-left">							
							<input type='submit' name='item_upt_cmd' value='Update Item' class='btn btn-primary form-control'/>					
					</div>
					<input type="hidden" name="order_number" value="{{$order->id}}">									
				</form>
				@endforeach
			@endif
			</div>	
		</div>
	</div>

@include('plugins.footer')