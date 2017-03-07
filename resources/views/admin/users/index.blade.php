@extends('admin/layouts/master')

@section('main-content')
    <header class="panel-heading">
        <h4>{{ trans('admin/general.modules.user') }}</h4>
        <div class="list-action">
            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
        </div>
    </header>
    <div class="panel-body">
        <div class="adv-table">
            <div class="dataTables_wrapper">
                <form method="get" action="" class="form-filter form-inline">
                    <label>{{ trans('form.name') }} <input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Name" value="{{ Request::get('name', '') }}"></label>
                    <label>{{ trans('form.email') }} <input type="text" name="email" class="form-control search-box-modules input-sm" placeholder="Email" value="{{ Request::get('email', '') }}"></label>
                    <label>{{ trans('form.phone') }} <input type="text" name="phone" class="form-control search-box-modules input-sm" placeholder="Phone" value="{{ Request::get('phone', '') }}"></label>
                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                </form>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('form.avatar') }}</th>
                            <th>{{ trans('form.name') }}</th>
                            <th>Liên hệ</th>
                            <th>Thông tin</th>
                            <th class="sorting text-center" aria-sort="descending" url-sort="/admin/users{{ createLinkSort2('active') }}">Active</th>
                            <th class="text-center">{{ trans('table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img width="40" src="{{ $user->getAvatarPath('sm_') }}" class="img-rounded" alt="{{ $user->name }}"></td>
                                <td>
                                    <ul class="list-unstyled p0">
                                        <li>{{ ucwords($user->name) }}</li>
                                        <li><i>{{ ucwords($user->nickname) }}</i></li>
                                        <li><span class="label label-default" data-toggle="tooltip" data-placement="top" title="Hình thức">{{ $user->getType() }}</span></li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="list-unstyled p0">
                                        <li><i class="fa fa-envelope-o"></i> <a class="text-primary" href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                                        <li><i class="fa fa-phone"></i> {{ $user->phone }}</li>
                                        <li><i class="fa fa-home"></i> {{ $user->address }}</li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="list-unstyled p0">
                                        <li><i class="emp-info">Thử việc từ</i>: {{ $user->trial_time }}</li>
                                        <li><i class="emp-info">Chính thức từ</i>: {{ $user->offical_time }}</li>
                                        <li><i class="emp-info">Hợp đồng từ</i>: {{ $user->contract_start_time }}</li>
                                        <li><i class="emp-info">Hợp đồng đến</i>: {{ $user->contract_end_time }}</li>
                                    </ul>
                                </td>
                                <td align="center">
                                    @if($user->id != 1 && Entrust::ability(['superadmin', 'manager'], 'user.edit'))
                                        <a href="{{ route('user.active', $user->id) }}" class="btn-action btn-xs btn-active-action">{!! $user->showCheckActive() !!}</a>
                                    @else
                                        <span class="{{ $user->isActive() ? 'text-success' : 'text-muted' }}">{{ $user->isActive() ? 'Active' : 'Inactive' }}</span>
                                    @endif
                                </td>
                                <td align="center">
                                    @if (Entrust::ability('superadmin', 'user.view_salary'))
                                        <a href="{{ route('user.salaries', $user->id) }}" class="btn act-btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Bảng lương"><i class="fa fa-money"></i></a>
                                    @endif
                                    @if (Entrust::ability('superadmin', 'user.view_workday'))
                                        <a href="{{ route('user.workdays', $user->id) }}" class="btn act-btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Chấm công"><i class="fa fa-bar-chart"></i></a>
                                    @endif
                                    @if($user->id != 1)
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn act-btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Sửa">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('user.destroy', $user->id) }}" class="btn act-btn btn-xs btn-danger btn-delete-action" data-toggle="tooltip" data-placement="top" title="Xóa">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    @endif
                                    <p class="text-info mt10">
                                        <i class="fa fa-group"></i>
                                        @foreach ($user->roles as $ind => $role)
                                            {{ $role->display_name }}
                                            @if ($user->roles->count() > 1 && $ind < ($user->roles->count() - 1))
                                                {{ ' / ' }}
                                            @endif
                                        @endforeach
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <p>Không có bản ghi nào!</p>
                        @endforelse
                    </tbody>
                </table>
                @include('admin/partials/paginate', ['data' => $users, 'appended' => ['email' => Request::get('email'), 'phone' => Request::get('phone')]])
            </div>
        </div>
    </div>
@stop
