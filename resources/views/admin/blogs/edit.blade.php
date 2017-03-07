@extends('admin/layouts/master')

@section('main-content')
    <header class="panel-heading">
        <h4>Sửa bài viết</h4>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="{{ route('blog.update', $blog->id) }}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image" class="col-sm-2 control-label">Ảnh bài viết</label>
                <div class="col-sm-10">
                    <div class="preview-uploader"><img src="{{ $blog->getThumbnail() }}" alt="Image" width="150"></div>
                    <p class="clearfix"></p>
                    <input name="image" class="file-upload" type="file" class="form-control" placeholder='Image' />
                </div>
            </div>

            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title" class="col-sm-2 control-label">Tiêu đề <b class="text-danger">*</b></label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề bài viết" value="{{ Request::old('title', $blog->title) }}" />
                {!! $errors->first('title', '<span class="help-inline text-danger">:message</span>') !!}
                </div>
            </div>

            <div class="form-group">
                <label for="teaser" class="col-sm-2 control-label">Tóm tắt</label>
                <div class="col-sm-10">
                   <textarea class="form-control" id="teaser" name="teaser" placeholder="Tóm tắt bài viết">{{ Request::old('teaser', $blog->teaser) }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="active_hot" class="col-sm-2 control-label">Danh mục</label>
                <div class="col-sm-10">
                    <select name="category_id" id="category" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>{{ $category->mask }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group hide">
                <label for="active_hot" class="col-sm-2 control-label">Phân loại</label>
                <div class="col-sm-10">
                    <select name="type" id="type" class="form-control">
                        <option value="{{ Nht\Hocs\Blogs\Blog::REGULAR }}" {{ $blog->type == Nht\Hocs\Blogs\Blog::REGULAR ? 'selected' : '' }}>Thông thường</option>
                        <option value="{{ Nht\Hocs\Blogs\Blog::MODULE }}" {{ $blog->type == Nht\Hocs\Blogs\Blog::MODULE ? 'selected' : '' }}>Module trang</option>
                    </select>
                </div>
            </div>

            <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                <label for="content" class="col-sm-2 control-label">Nội dung <b class="text-danger">*</b></label>
                <div class="col-sm-10">
                <textarea class="form-control ckeditor" placeholder="Nội dung bài viết" name="content" rows="6" style="visibility: hidden; display: none;">{{ Request::old('content') ? Request::old('content') : $blog->content}}</textarea>
                {!! $errors->first('content', '<span class="help-inline text-danger">:message</span>') !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
                <a href="{{ route('blog.store') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                </div>
            </div>
            {!! csrf_field() !!}
        </form>
    </div>
@stop
@section('scripts')
<link rel="stylesheet" type="text/css" href="/js/jquery-tags-input/jquery.tagsinput.css" />
<script type="text/javascript" src="/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
<script src="/js/jquery-tags-input/jquery.tagsinput.js"></script>
<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
@stop
