@include('plugins.dash_header')

			<div class="row wrapper">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 form-wrapper">
					<div class="form-group">
						<img src="img/xara.png" alt="Xara Financials" width="70%" height="70px;">
						<h3>Reset Password</h3>
						Don't have an Account? <a href="{{{ URL::to('/signup') }}}">SIGNUP</a>
					</div>
					<form role="form" method="POST" action="{{{ URL::to('/reset_pass') }}}">
						<input type="hidden" name="token" value="{{{ $token }}}">
					    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

					    <div class="form-group">
					        <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
					        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
					    </div>
					    <div class="form-group">
					        <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
					        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
					    </div>

					    @if (Session::get('error'))
					        <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
					    @endif

					    @if (Session::get('notice'))
					        <div class="alert">{{{ Session::get('notice') }}}</div>
					    @endif

					    <div class="form-actions form-group">
					        <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.forgot.submit') }}}</button>
					    </div>
					</form>
				</div>
			</div>
		
@include('plugins.footer')