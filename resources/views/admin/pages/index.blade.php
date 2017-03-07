@extends('admin/layouts/master')

@section('main-content')
    <header class="panel-heading">
        <h4>Danh sách trang</h4>
        <div class="list-action">
            <a href="{{ route('page.create') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
        </div>
    </header>
    <div class="panel-body">
        <div class="adv-table">
            <div class="dataTables_wrapper">
                <form method="get" action="" class="form-filter form-inline">
                    <label><input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Tìm theo tiêu đề" value="{{ Request::get('name', '') }}"></label>
                    <label>Loại
                        <select name="type" class="form-control input-sm">
                            <option value="{{ Nht\Hocs\Pages\Page::SINGLE }}" {{ Request::get('type', -1) == Nht\Hocs\Pages\Page::SINGLE ? 'selected' : '' }}>Trang tĩnh</option>
                            <option value="{{ Nht\Hocs\Pages\Page::LIST }}" {{ Request::get('type', -1) == Nht\Hocs\Pages\Page::LIST ? 'selected' : '' }}>Danh sách</option>
                            <option value="{{ Nht\Hocs\Pages\Page::MODULE }}" {{ Request::get('type', -1) == Nht\Hocs\Pages\Page::MODULE ? 'selected' : '' }}>Module</option>
                        </select>
                    </label>
                    <label>Trạng thái
                        <select name="active" class="form-control input-sm">
                            <option value="{{ Nht\Hocs\Pages\Page::ACTIVE }}" {{ Request::get('active', -1) == Nht\Hocs\Pages\Page::ACTIVE ? 'selected' : '' }}>Đang hiển thị</option>
                            <option value="{{ Nht\Hocs\Pages\Page::INACTIVE }}" {{ Request::get('active', -1) == Nht\Hocs\Pages\Page::INACTIVE ? 'selected' : '' }}>Không hiển thị</option>
                        </select>
                    </label>
                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                </form>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="sorting" aria-sort="descending" url-sort="{{ createLinkSort2('name') }}">Tiêu đề</th>
                            <th class="sorting" aria-sort="descending" url-sort="{{ createLinkSort2('type')}}">Loại trang</th>
                            <th align="center">Số bài viết</th>
                            <th class="sorting" aria-sort="descending" url-sort="{{ createLinkSort2('active')}}">Trạng thái</th>
                            <th align="center">{{ trans('table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pages as $key => $page)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->getType() }}</td>
                                <td align="center">{{ $page->blogs()->count() }}</td>
                                <td>{!! makeActiveButton(route('page.active', [$page->id]), $page->active) !!}</td>
                                <td>
                                    <a href="{{ route('page.edit', $page->id) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('page.destroy', $page->id) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Chưa có bản ghi nào!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @include('admin/partials/paginate', ['data' => $pages, 'appended' => Request::all()])
            </div>
        </div>
    </div>
@stop
