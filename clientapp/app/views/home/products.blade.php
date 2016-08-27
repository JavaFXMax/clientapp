@include('plugins.dash_header')

	<div class="container">
		<div class="row wrapper-menu">
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 row-wrapper">
				<h3 class="dash">Order Items</h3>
			</div>			
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 row-wrapper">
				<p class="dash">
					@foreach($client_top_details as $order)						
						Order #: {{$order_no=$order->ord_num}}&nbsp;|&nbsp;
						Client: {{$client=$order->clien_name}}&nbsp;|&nbsp;
						Date placed: {{$date=$order->date_placed}}
					@endforeach
				</p>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 row-wrapper">
				<?php $message = Session::get('message');?>
					@if(isset($message))
						<span class='alert alert-danger'>{{$message}}</span>	
					@endif	
			</div>	
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 form-wrapper table-responsive">
				<table class="table table-bordered table-hover table-sm">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Quantity</th>
							<th>Price</th>	
							<th>Total</th>
							<th>Action</th>						
						</tr>
					</thead>
					<tbody>
						<?php 
							$count=1;	
							$total=0;

							function asMoney($value) {
								return number_format($value, 2);
							}
						?>
						@if(isset($client_products) && count($client_products))
						@foreach($client_products as $order)
						    <?php   
						       $name=$order->name;
							   $quan=$order->qty;
							   $pric=$order->prc;
							   $total1=$quan*$pric;							  
							   $total += $total1;
							 ?>
						<tr>
							<td>{{$count}}</td>
							<td>{{$name}}</td>
							<td>{{$quan}}</td>
							<td>{{asMoney($pric)}}</td>
							<td>{{asMoney($total1)}}</td>
							<td><center><a href="{{{ URL::to('user/edit_item/'.$order->product_id) }}}"><img src='../../img/edit.png' alt='Edit Item'/></a>&emsp;
							<a href="{{{ URL::to('user/edit_item/delete/'.$order->product_id) }}}"><img src='../../img/delete.png' alt='Delete item'/></a></center></td>					
						<!--<td>
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					                    Action <span class="caret"></span>
					                </button>
					                <ul class="dropdown-menu" role="menu">
					                    <li><a href="{{{ URL::to('user/orders') }}}">View</a></li>
					                    <li><a href="{{{ URL::to('user/orders') }}}">Pay</a></li>
					                    <li><a href="{{{ URL::to('user/orders') }}}" onclick="return (confirm('Are you sure you want to cancel this order?'))">Cancel</a></li>
					                </ul>
								</div>
							</td> -->
						</tr>
						<?php $count++ ?>
						@endforeach
						@endif
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td><strong>Grand Total</strong></td>
							<td><strong>{{$sum=asMoney($total)}}</strong></td>
						</tr>
					</tbody>
					<?php 
						foreach($client_top_details as $ctd){
							$id=$ctd->erpid;
						}						
						Session::set('pay_details',[
							 'ord_id'       =>$order_no,
							 'client_name' =>$client,
							 'date_placed' =>$date,
							 'total_amount'=>$sum,
							 'pay_id'	   =>$id
							]);
					?>
				</table>	
				@if(isset($client_products) && count($client_products))																	
				<div class="form-group pull-right">
					<a href="{{ URL::to('user/orders') }}" class="btn btn-danger btn-sm">Cancel</a>&emsp;
					<a href="{{ URL::to('user/orders/process') }}" name="btn-commit" class="btn btn-primary btn-sm">Submit Payment</a>&nbsp;					
				</div>	
				@endif						
			</div>
		</div>
	</div>

@include('plugins.footer')