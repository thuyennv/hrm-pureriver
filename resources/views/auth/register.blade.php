@extends('auth/layout')

@section('content')
	<div class="row">
		<div class="inner_wrap col-sm-12">
			<form method="post" action="{{ route('auth.post.register') }}">
				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					<input class="form-control" type="text" placeholder="Email" autocomplete="off" name="email" value="{{ Request::old('email') }}">
					{!! $errors->first('email', '<span class="help-inline text-danger">:message</span>') !!}
				</div>

				<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
					<input class="form-control" type="password" placeholder="Mật khẩu" autocomplete="off" name="password" value="{{ Request::get('password') }}"/>
					{!! $errors->first('password', '<span class="help-inline text-danger">:message</span>') !!}
				</div>

				<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
					<input class="form-control" type="password" placeholder="Nhập lại mật khẩu" autocomplete="off" name="password_confirmation" value="{{ Request::get('password_confirmation') }}"/>
					{!! $errors->first('password_confirmation', '<span class="help-inline text-danger">:message</span>') !!}
				</div>

				<div class="row" id="auth-footer">
					<button type="submit" class="btn btn-danger">Đăng ký</button>
					<a href="/" class="btn btn-default">Trở lại</a>
					<div class="text-center auth-notice-lbl">
						<span>Bạn đã có tài khoản, hãy <a class="link-color" href="{{ route('auth.login') }}">đăng nhập</a></span>
					</div>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
@stop
