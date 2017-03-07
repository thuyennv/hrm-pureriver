@extends('admin/layouts/master')

@section('main-content')
    <header class="panel-heading">
        <h4>{{ trans('admin/general.modules.category') }}</h4>
        <div class="list-action">
            <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
        </div>
    </header>
    <div class="panel-body">
        <div class="adv-table">
            <div class="dataTables_wrapper">
                <form method="get" action="" class="form-filter form-inline">
                    <label>{{ trans('form.categories.category_name') }} <input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Tìm theo tên danh mục" value="{{ Request::get('name', '') }}"></label>
                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                </form>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('form.categories.category_name') }}</th>
                            <th class="text-center">Số bài viết</th>
                            <th width="100" class="text-center sorting" aria-sort="descending" url-sort="{{ createLinkSort2('active') }}">{{ trans('table.active') }}</th>
                            <th width="100" class="text-center">{{ trans('table.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($category as $key => $cate)
                            <?php
                                $c = new \Nht\Hocs\Categories\Category;
                                $c->fill($cate);
                            ?>
                            <tr>
                                <td width="50">{{ $key + 1 }}</td>
                                <td class="{{ $c->level == 2 || $c->level == 1  ? 'text-strong' : '' }}">{{ $cate['mask'] }}</td>
                                <td class="text-center">{{ $c->blogs()->count() }}</td>
                                <td class="text-center">
                                    {!! makeActiveButton(route('admin.category.active', [$c->id]), $c->active) !!}
                                </td>
                                <td class="text-center">
                                    {!! makeEditButton(route('admin.category.edit', [$c->id])) !!}
                                    {!! makeDeleteButton(route('admin.category.destroy', [$c->id])) !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Chưa có bản ghi nào!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
