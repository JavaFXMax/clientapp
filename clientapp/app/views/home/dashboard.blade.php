@include('plugins.dash_header')
		
		<div class="container">
			<div class="row wrapper-menu">
				<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 row-wrapper">
					<h3 class="dash">Quicklinks</h3>
				</div>
				<div class="col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-10 col-xs-offset-1 menu">
					<a href="{{ URL::to('user/orders') }}">
						<div class="form-group">
							<img src="../img/order.png" alt="Orders">
						</div>
						ORDERS
					</a>
				</div>
				<div class="col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-10 col-xs-offset-1 menu">
					<a href="{{ URL::to('user/orders') }}">
						<div class="form-group">
							<img src="../img/order.png" alt="Products">
						</div>
						PRODUCTS
					</a>
				</div>
			</div>
			<div class="row wrapper-menu">
				<div class="col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-10 col-xs-offset-1 menu">
					<a href="{{ URL::to('user/invoices') }}">
						<div class="form-group">
							<img src="../img/invoice.png" alt="Invoices">
						</div>
						INVOICES
					</a>
				</div>
				<div class="col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-10 col-xs-offset-1 menu">
					<a href="{{ URL::to('user/statements') }}">
						<div class="form-group">
							<img src="../img/statement.png" alt="Statements">
						</div>
						STATEMENTS
					</a>
				</div>
			</div>

@include('plugins.footer')