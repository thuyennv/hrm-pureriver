@extends('admin/layouts/master')

@section('main-content')
    <div class="panel-heading">
	   <h4>Cài đặt {{ trans('admin/general.modules.social') }}</h4>
    </div>
	<div class="panel-body">
        <form class="form-horizontal" method="post" action="{{ url('/admin/settings/social') }}">
			{{-- Js_Codes--}}
			<div class="form-group">
				<label for="skype" class="col-sm-3 control-label">{{ trans('form.settings.js_codes') }}</label>
				<div class="col-sm-6">
					<textarea class="form-control" id="js_codes" name="js_codes" placeholder="{{ trans('form.settings.js_codes') }}" rows="10">{{ Request::old('js_codes', $social->js_codes) }}</textarea>
					<p class="text-muted text-social">Google analytics, Facebook, Vchat...</p>
				</div>
			</div>

			<div class="form-group">
				<label for="skype" class="col-sm-3 control-label">{{ trans('form.settings.facebook') }}</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="facebook" name="facebook" placeholder="{{ trans('form.settings.facebook') }}" value="{{ Request::old('facebook', $social->facebook) }}" />
				</div>
			</div>

			<div class="form-group">
				<label for="skype" class="col-sm-3 control-label">{{ trans('form.settings.googleplus') }}</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="googleplus" name="googleplus" placeholder="{{ trans('form.settings.googleplus') }}" value="{{ Request::old('googleplus', $social->googleplus) }}" />
				</div>
			</div>

			<div class="form-group">
				<label for="skype" class="col-sm-3 control-label">{{ trans('form.settings.twitter') }}</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="twitter" name="twitter" placeholder="{{ trans('form.settings.twitter') }}" value="{{ Request::old('twitter', $social->twitter) }}" />
				</div>
			</div>

			<div class="form-group">
				<label for="skype" class="col-sm-3 control-label">{{ trans('form.settings.linkin') }}</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="linkin" name="linkin" placeholder="{{ trans('form.settings.linkin') }}" value="{{ Request::old('linkin', $social->linkin) }}" />
				</div>
			</div>

			<div class="form-group">
				<label for="skype" class="col-sm-3 control-label">{{ trans('form.settings.youtube') }}</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="youtube" name="youtube" placeholder="{{ trans('form.settings.youtube') }}" value="{{ Request::old('youtube', $social->youtube) }}" />
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
					<a href="{{ url('/admin/settings/social') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
