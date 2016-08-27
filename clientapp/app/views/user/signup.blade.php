@include('plugins.dash_header')

			<div class="row wrapper">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 form-wrapper">
					<div class="form-group">
						<img src="img/xara.png" alt="Xara Financials" width="70%" height="70px;">
						<h3>Create an Account</h3>
						Already have an Account? <a href="{{{ URL::to('/login') }}}">LOGIN</a>
					</div>
					<form role="form" method="POST" action="{{{ URL::to('/signup') }}}">
						<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
						<div class="form-group">
							<label class="">Company/ Client Name: </label>
							<input class="form-control" type="text" name="name" value="" placeholder="Company/ Client Name" required>
						</div>
						<div class="form-group">
							<label class="">Email Address: </label>
							<input class="form-control" type="email" name="email" value="" placeholder="Email Address" required>
						</div>
						<div class="form-group">
							<label class="">Phone Number: </label>
							<input class="form-control" type="text" name="phone" value="" placeholder="Phone Number" required>
						</div>
						<div class="form-group">
							<label for="type">Client Type:</label>
							<select name="type" class="form-control" required>
								<option value="">Client Type...</option>
								<option value="Customer">Customer</option>
								<option value="Supplier">Supplier</option>
							</select>
						</div>
						<div class="form-group">
							<label class="">Password: </label>
							<input class="form-control" type="password" name="password" value="" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label class="">Confirm Password: </label>
							<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
						</div>
						
						@if (Session::get('error'))
				            <div class="alert alert-error alert-danger">
				                @if (is_array(Session::get('error')))
				                    {{ head(Session::get('error')) }}
				                @endif
				            </div>
				        @endif

				        @if (Session::get('notice'))
				            <div class="alert">{{ Session::get('notice') }}</div>
				        @endif

						<div class="form-group text-right">
							<input class="btn btn-primary" type="submit" name="btn-register" value="Create Account">
						</div>
					</form>
				</div>
			</div>
		
@include('plugins.footer')
