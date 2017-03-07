@extends('admin/layouts/master')

@section('main-content')
    <header class="panel-heading">
        <h4>{{ trans('admin/general.modules.permissions') }}</h4>
        <div class="list-action">
            <a href="{{ route('permission.create') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
        </div>
    </header>
    <div class="panel-body">
        <div class="adv-table">
            <div class="dataTables_wrapper">
                <form method="get" action="" class="form-filter form-inline">
                    <label>{{ trans('form.perm_key') }} <input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="{{ trans('form.perm_key') }}" value="{{ Request::get('name', '') }}"></label>
                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                </form>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="sorting" aria-sort="descending" url-sort="{{ createLinkSort2('display_name') }}">{{ trans('form.perm_name') }}</th>
                            <th class="sorting" aria-sort="descending" url-sort="{{ createLinkSort2('name') }}">{{ trans('form.perm_key') }}</th>
                            <th>{{ trans('table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $permission->display_name }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('permission.destroy', $permission->id) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('admin/partials/paginate', ['data' => $permissions, 'appended' => []])
            </div>
        </div>
    </div>
@stop
