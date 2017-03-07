@extends('admin/layouts/master')

@section('main-content')
    <div class="panel-heading">
	   <h4>Cài đặt {{ trans('admin/general.modules.metadata') }}</h4>
    </div>
	<div class="panel-body">
		<form class="form-horizontal" method="post" action="{{ url('/admin/settings/metadata') }}">
			{{-- Meta title --}}
			<div class="form-group">
				<label for="skype" class="col-sm-3 control-label">{{ trans('form.settings.meta_title') }}</label>
				<div class="col-sm-6">
					<textarea class="form-control" id="meta_title" name="meta_title" placeholder="{{ trans('form.settings.meta_title') }}">{{ Request::old('meta_title', $metadata->meta_title) }}</textarea>
				</div>
			</div>

			{{-- Meta keyword --}}
			<div class="form-group">
				<label for="skype" class="col-sm-3 control-label">{{ trans('form.settings.meta_keyword') }}</label>
				<div class="col-sm-6">
					<textarea class="form-control" id="meta_keyword" name="meta_keyword" placeholder="{{ trans('form.settings.meta_keyword') }}">{{ Request::old('meta_keyword', $metadata->meta_keyword) }}</textarea>
				</div>
			</div>

			{{-- Meta description --}}
			<div class="form-group">
				<label for="skype" class="col-sm-3 control-label">{{ trans('form.settings.meta_description') }}</label>
				<div class="col-sm-6">
					<textarea class="form-control" id="meta_description" name="meta_description" placeholder="{{ trans('form.settings.meta_description') }}">{{ Request::old('meta_description', $metadata->meta_description) }}</textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
					<a href="{{ url('/admin/settings/metadata') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
