@extends('admin/layouts/master')

@section('main-content')
    <div class="panel-heading">
       <h4>{{ trans('admin/general.update_info') . ' ' . trans('admin/general.modules.roles') }}</h4>
    </div>
	<div class="panel-body">
		<form class="form-horizontal" method="post" action="{{ url('/admin/roles', ['id' => $role->id]) }}">
			<div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
				<label for="display_name" class="col-sm-3 control-label">{{ trans('form.role_name') }} <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					<input type="display_name" class="form-control" id="display_name" name="display_name" placeholder="{{ trans('form.role_name') }}" value="{{ Request::old('display_name', $role->display_name) }}" />
					<i class="help-inline text-muted">Ex: Nhân viên</i>
					{!! $errors->first('display_name', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
				<label for="name" class="col-sm-3 control-label">{{ trans('form.role_key') }} <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('form.role_key') }}" value="{{ Request::old('name', $role->name) }}" />
					<i class="help-inline text-muted">Ex: staff</i>
					{!! $errors->first('name', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
				<label for="description" class="col-sm-3 control-label">{{ trans('form.description') }}</label>
				<div class="col-sm-6">
					<textarea class="form-control" id="description" name="description" placeholder="{{ trans('form.description') }}">{{ Request::old('description', $role->description) }}</textarea>
					{!! $errors->first('description', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group">
				<label for="perm_name" class="col-sm-3 control-label">{{ trans('form.perm_name') }}</label>
				<div class="col-sm-6">
					<ul class="perm-list list-inline checkbox-list">
                        @foreach ($permissions as $key => $permList)
                            <h5 class="perm-key"><i class="fa fa-ellipsis-v"></i> {{ ucwords($key) }}</h5>
                            <ul class="perm-list list-inline checkbox-list">
                                @foreach ($permList as $perm)
                                    <li>
                                        <label class="tooltips noselect" for="perm_{{ $perm->id }}" data-placement="top" data-toggle="tooltip" data-original-title="{{ $perm->description }}">
                                            <input class="checkbox-child" type="checkbox" id="perm_{{ $perm->id }}" name="perms[]" value="{{ $perm->id }}" {{ in_array($perm->id, $role_permissions) ? 'checked' : '' }}> {{ $perm->display_name }}
                                            <p class="text-muted">{{ $perm->sub }}</p>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
					</ul>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
					<a href="{{ url('/admin/roles') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
