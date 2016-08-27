<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Xara Financials Client App</title>
		{{ HTML::script('js/jquery.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/client.css') }}
	</head>

	<body class="">
		<header>
			<div class="container">
				<div class="row">
					<div class="head">
						<h2>Xara Financials</h2>
						<div class="dropdown pull-right">
							<!--<img src="../img/menu.png" alt="Menu" class="btn dropdown-toggle" type="button" data-toggle="dropdown">-->
						    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
						    	<img src="../../img/menu-1.png" alt="MENU">
						    </button>
						    <ul class="dropdown-menu dropdown-menu-left">
						    	<li><a href="{{ URL::to('user/dashboard') }}">HOME</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="{{ URL::to('user/orders') }}">ORDERS</a></li>								
								<li role="separator" class="divider"></li>
								<li><a href="{{ URL::to('user/invoices') }}">INVOICES</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="{{ URL::to('user/statements') }}">STATEMENTS</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="{{ URL::to('/logout') }}">LOGOUT</a></li>
						    </ul>
						</div>
					</div>
				</div>
			</div>
		</header>