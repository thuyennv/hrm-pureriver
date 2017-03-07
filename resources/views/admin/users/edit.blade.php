@extends('admin/layouts/master')

@section('main-content')
    <div class="panel-heading">
	   <h4>{{ trans('admin/general.update_info') . ' ' . trans('admin/general.modules.users') }}</h4>
    </div>
	<div class="panel-body">
		<form class="form-horizontal" method="post" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-3 control-label">{{ trans('form.avatar') }}</label>
				<div class="col-sm-6">
                    <div class="preview-uploader"><img width="150" src="{{ $user->getAvatarPath('md_') }}" alt="Avatar"></div>
                    <p class="clearfix"></p>
                    <input name="avatar" class="file-upload" type="file" class="form-control" placeholder='Image' />
				</div>
			</div>
			<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
				<label for="email" class="col-sm-3 control-label">{{ trans('form.email') }} <b class="text-danger">*</b></label>
				<div class="col-sm-6">
			   	<input type="email" class="form-control" id="email" name="email" placeholder="{{ trans('form.email') }}" value="{{ Request::old('email', $user->email) }}">
			   	{!! $errors->first('email', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Họ tên <b class="text-danger">*</b></label>
				<div class="col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
			   	<input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('form.name') }}" value="{{ Request::old('name', $user->name) }}">
			   	{!! $errors->first('name', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
            <div class="form-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
                <label for="nickname" class="col-sm-3 control-label">Chức danh <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="nickname" name="nickname" placeholder="{{ trans('form.nickname') }}" value="{{ Request::old('nickname', $user->nickname) }}">
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
                <label for="type" class="col-sm-3 control-label">Hình thức</label>
                <div class="col-sm-6">
                    <select class="form-control" id="type" name="type">
                        @foreach ($types as $key => $type)
                            <option value="{{ $key }}" {{ Request::old('type') == $key ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-3 control-label">Thử việc từ</label>
                <div class="col-sm-6">
                    <input class="form-control date-picker" type="text" name="trial_time" placeholder="dd/mm/yyyy" value="{{ Request::old('trial_time', $user->trial_time) }}">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-3 control-label">Chính thức từ</label>
                <div class="col-sm-6">
                    <input class="form-control date-picker" type="text" name="offical_time" placeholder="dd/mm/yyyy" value="{{ Request::old('offical_time', $user->offical_time) }}">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-3 control-label">Hợp đồng từ</label>
                <div class="col-sm-6">
                    <input class="form-control date-picker" type="text" name="contract_start_time" placeholder="dd/mm/yyyy" value="{{ Request::old('contract_start_time', $user->contract_start_time) }}">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-3 control-label">Hợp đồng tới</label>
                <div class="col-sm-6">
                    <input class="form-control date-picker" type="text" name="contract_end_time" placeholder="dd/mm/yyyy" value="{{ Request::old('contract_end_time', $user->contract_end_time) }}">
                </div>
            </div>
			<div class="form-group">
				<label for="active" class="col-sm-3 control-label">{{ trans('form.active') }}</label>
				<div class="col-sm-6">
					<select class="form-control" id="active" name="active">
						<option value="1" {{ Request::old('active', 1) == $user->active ? 'selected' : '' }}>Có</option>
						<option value="0" {{ Request::old('active', 0) == $user->active ? 'selected' : '' }}>Không</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="role_name" class="col-sm-3 control-label">{{ trans('form.role_name') }}</label>
				<div class="col-sm-6">
					<ul class="role-list list-inline checkbox-list">
						@if (Entrust::ability('superadmin', 'user.grant'))
							@foreach ($roles as $role)
                                <?php
                                    if ($role->name == 'superadmin' && !Auth::user()->hasRole('superadmin')) {
                                        continue;
                                    }
                                ?>
								<li>
									<label class="tooltips noselect {{ $role->name == 'superadmin' ? 'the-god-class' : '' }}" for="role_{{ $role->id }}" for="role_{{ $role->id }}" data-placement="top" data-toggle="tooltip" data-original-title="{{ $role->description }}">
										<input class="checkbox-child" type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, $user_roles) ? 'checked' : '' }}> {{ $role->display_name }}
										<p class="text-muted">{{ $role->name }}</p>
									</label>
								</li>
							@endforeach
						@else
                            <li>
                                <label class="control-label text-danger">Không có quyền thực thi</label>
                            </li>
                        @endif
					</ul>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
			   	<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
			   	<a href="{{ url('/admin/users') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
