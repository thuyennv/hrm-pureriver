@extends('admin/layouts/master')

@section('main-content')
    <header class="panel-heading">
        <h4>Quản lý bài viết</h4>
        <div class="list-action">
            <a href="{{ route('blog.create') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
        </div>
    </header>
    <div class="panel-body">
        <div class="adv-table">
            <div class="dataTables_wrapper">
                <form method="get" action="" class="form-filter form-inline">
                    <label>Tiêu đề <input type="text" name="title" class="form-control search-box-modules input-sm" placeholder="Tiêu đề" value="{{ Request::get('title', '') }}"></label>
                    <label>Danh mục
                        <select name="category_id" id="f_category" class="form-control input-sm">
                            <option value="" >Danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}" {{ $category['id'] == Request::get('category_id', '') ? 'selected="selected"' : '' }}>{{ $category['mask'] }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label>Phân loại
                        <select name="type" id="f_type" class="form-control input-sm">
                            <option value="{{ Nht\Hocs\Blogs\Blog::REGULAR }}" {{ Request::get('type', -1) == Nht\Hocs\Blogs\Blog::REGULAR ? 'selected' : '' }}>Thông thường</option>
                            <option value="{{ Nht\Hocs\Blogs\Blog::MODULE }}" {{ Request::get('type', -1) == Nht\Hocs\Blogs\Blog::MODULE ? 'selected' : '' }}>Module trang</option>
                        </select>
                    </label>
                    <label>Trạng thái
                        <select name="active" id="f_active" class="form-control input-sm">
                            <option value="{{ Nht\Hocs\Blogs\Blog::ACTIVE }}" {{ Request::get('active', -1) == Nht\Hocs\Blogs\Blog::ACTIVE ? 'selected' : '' }}>Đang hiển thị</option>
                            <option value="{{ Nht\Hocs\Blogs\Blog::INACTIVE }}" {{ Request::get('active', -1) == Nht\Hocs\Blogs\Blog::INACTIVE ? 'selected' : '' }}>Không hiển thị</option>
                        </select>
                    </label>
                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                </form>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th width="140">Ảnh</th>
                            <th class="sorting" aria-sort="descending" url-sort="{{ createLinkSort2('title') }}">Tiêu đề</th>
                            <th class="sorting" aria-sort="descending" url-sort="{{ createLinkSort2('type') }}">Phân loại</th>
                            <th class="sorting" aria-sort="descending" url-sort="{{ createLinkSort2('category_id') }}">Danh mục</th>
                            <th width="70" class="sorting" aria-sort="descending" url-sort="{{ createLinkSort2('active') }}">Active</th>
                            <th width="70" class="sorting" aria-sort="descending" url-sort="{{ createLinkSort2('hot') }}">HOT</th>
                            <th align="center">{{ trans('table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $key => $blog)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td align="center">
                                    <a href="{{ $blog->getUrl() }}" class="blog-image img-thumbnail" style="background: url('{{ $blog->getThumbnail('sm_') }}') center center no-repeat; height: 60px; width: 100px; background-size: cover; display: block;"></a>
                                </td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->type == Nht\Hocs\Blogs\Blog::REGULAR ? 'Thông thường' : 'Module trang' }}</td>
                                <td>{{ $blog->category->name }}</td>
                                @if(Entrust::hasRole('superadmin'))
                                    <td class="text-center">
                                        <a href="{{ route('blog.active', $blog->id) }}" class="btn-action btn-xs btn-active-action">{{ $blog->showCheckActive() }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('blog.hot', $blog->id) }}" class="btn-action btn-xs btn-active-action">{{ $blog->showCheckHot() }}</a>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <a href="" class="btn-active btn btn-xs btn-primary">{{ $blog->showCheckActive() }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="btn-active btn btn-xs btn-primary">{{ $blog->showCheckHot() }}</a>
                                    </td>
                                @endif
                                <td width="70" class="text-center">
                                    <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('blog.destroy', $blog->id) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('admin/partials/paginate', ['data' => $blogs, 'appended' => ['title' => Request::get('title'), 'category' => Request::get('category_id')]])
            </div>
        </div>
            </div>
@stop
@section('script')
<script type="text/javascript">
    $(function() {
       $('.sorting').click(function(ev) {
          return window.location.href = $(this).attr('url-sort');
       });
    });
</script>
@stop
