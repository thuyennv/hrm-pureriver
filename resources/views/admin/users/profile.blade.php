@extends('admin/layouts/master')

@section('main-content')
    <header class="panel-heading">
	   <h4>{{ trans('admin/general.update_info') . ' ' . trans('admin/general.modules.users') }}</h4>
    </header>
	<div class="panel-body">
		<form class="form-horizontal" method="post" action="{{ route('user.updateProfile', $user->id) }}" enctype="multipart/form-data">
			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">{{ trans('form.avatar') }}</label>
				<div class="col-sm-6">
					<p><img src="{{ $user->getAvatarPath('md_') }}" width="140" class="img-thumbnail" alt="Avatar"></p>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">{{ trans('form.avatar') }}</label>
				<div class="col-sm-6 text-center">
					<input type="file" name="avatar" class="form-control">
				</div>
			</div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Họ tên <b class="text-danger">*</b></label>
                <div class="col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên" value="{{ Request::old('name', $user->name) }}">
                {!! $errors->first('name', '<span class="help-inline text-danger">:message</span>') !!}
                </div>
            </div>
			<div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
				<label for="nickname" class="col-sm-3 control-label">Chức danh <b class="text-danger">*</b></label>
				<div class="col-sm-6">
			   	<input type="text" class="form-control" id="nickname" name="nickname" placeholder="Chức danh" value="{{ Request::old('nickname', $user->nickname) }}">
			   	{!! $errors->first('nickname', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
				<label for="phone" class="col-sm-3 control-label">{{ trans('form.phone') }} <b class="text-danger">*</b></label>
				<div class="col-sm-6">
			   	<input type="text" class="form-control" id="phone" name="phone" placeholder="{{ trans('form.phone') }}" value="{{ Request::old('phone', $user->phone) }}">
			   	{!! $errors->first('phone', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
				<label for="address" class="col-sm-3 control-label">{{ trans('form.address') }} <b class="text-danger">*</b></label>
				<div class="col-sm-6">
			   	<input type="text" class="form-control" id="address" name="address" placeholder="{{ trans('form.address') }}" value="{{ Request::old('address', $user->address) }}">
			   	{!! $errors->first('address', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
			   	<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
			   	<a href="{{ url('/login/dashboard') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
