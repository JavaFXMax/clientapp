@include('plugins.dash_header')

	<div class="container">
		<div class="row wrapper-menu">
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 row-wrapper">
				<h3 class="dash">Make Payment</h3>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 row-wrapper">
				<center>
				<?php $message = Session::get('message');?>
					@if(isset($message))
						<strong><span class='alert alert-info'>{{$message}}</span></strong>	
					@endif
				</center>	
			</div>				
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 row-wrapper">
				<p class="dash">
				<?php
					$client_top=Session::get('pay_details');
					//dd($client_top);
				?>
					
						Order #: {{$client_top['ord_id']}}&nbsp;|&nbsp;
						Client: {{$client_top['client_name']}}&nbsp;|&nbsp;
						Date placed: {{$client_top['date_placed']}}
					
				</p>
			</div>					
			<!-- PAYMENT INSTRUCTIONS -->
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 ">
				<div class="col-md-6 col-md-offset-3 pay">
						<img src='../../img/lipa.png' alt='Lipa na Mpesa'/>
						<h3 class="dash">Payment Instructions</h3>
						<ol>
							<li>Go to M-PESA Menu </li>
							<li>Go to Lipa Na M-PESA</li>
							<li>Select Buy Goods</li>
							<li>Enter the Till Number</li>
							<li>Enter the amount:  <strong>{{$client_top['total_amount']}}</strong></li>
							<li>Enter your M-PESA PIN</li>
							<li>Confirm that all details are correct and press OK</li>
						</ol>
						<form role="form" method="POST" action="{{{ URL::to('home/payment/complete') }}}">
							<div class="form-group">
								<label class="">Enter Transaction ID: </label>
								<input class="form-control" type="text" name="transaction_id" required>
							</div>					
							<div class="form-group text-right">
								<input class="btn btn-success btn-sm" type="submit" name="btn-add_item" value="Lipa na Mpesa">
							</div>
						</form>	
				</div>	
			</div>	
		</div>
	</div>

@include('plugins.footer')