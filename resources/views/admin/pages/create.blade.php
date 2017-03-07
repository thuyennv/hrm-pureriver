@extends('admin/layouts/master')

@section('main-content')
    <header class="panel-heading">
        <h4>Tạo mới trang</h4>
        <div class="list-action">
            <a href="{{ route('page.create') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
        </div>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="{{ route('page.store') }}">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#info">Thông tin</a></li>
                <li><a data-toggle="tab" href="#metadata">Metadata</a></li>
            </ul>
            <div class="tab-content">
                <div id="info" class="tab-pane active">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name" class="col-sm-2 control-label">Tiêu đề <b class="text-danger">*</b></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tiêu đề bài viết" value="{{ Request::old('name') }}" />
                            {!! $errors->first('name', '<span class="help-inline text-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type" class="col-sm-2 control-label">Loại trang</label>
                        <div class="col-sm-7">
                            <select class="form-control" name="type" id="type">
                                <option value="0" {{ Request::old('type', '') == 0 ? 'selected' : '' }}>Trang tĩnh</option>
                                <option value="1" {{ Request::old('type', '') == 1 ? 'selected' : '' }}>Danh sách</option>
                                <option value="2" {{ Request::old('type', '') == 2 ? 'selected' : '' }}>Module</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="metadata" class="tab-pane">
                    <div class="form-group">
                        <label for="metadescription" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="metadescription" name="metatitle" placeholder="Title" value="{{ Request::old('metatitle') }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="metatitle" class="col-sm-2 control-label">Keywords</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="metakeywords" name="metakeywords" placeholder="Keywords" value="{{ Request::old('metakeywords') }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="metatitle" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="metadescription" name="metadescription" placeholder="Description" value="{{ Request::old('metadescription') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
                    <a href="{{ route('blog.store') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                </div>
            </div>
            {!! csrf_field() !!}
        </form>
    </div>
@stop
