@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>Danh sách {{ trans('admin/general.modules.roles') }}</h4>
            <div class="list-action">
                @if (Auth::user()->hasRole('superadmin'))
                    <a href="{{ route('role.create') }}" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
                @endif
            </div>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th class="sorting" aria-sort="descending" url-sort="{{ route("role.index") . createLinkSort2('display_name') }}">{{ trans('form.role_name') }}</th>
								<th class="sorting" aria-sort="descending" url-sort="{{ route("role.index") . createLinkSort2('name')}}">{{ trans('form.role_key') }}</th>
								<th>{{ trans('table.count_role_users') }}</th>
								<th align="center">{{ trans('table.actions') }}</th>
							</tr>
						</thead>
						<tbody>
                            <?php $count = 1; ?>
							@foreach ($roles as $role)
                                <?php
                                    if ($role->id == 1 && Auth::user()->id != 1) {
                                        continue;
                                    }
                                ?>
								<tr>
									<td>{{ $count++ }}</td>
									<td>{{ $role->display_name }}</td>
									<td>{{ $role->name }}</td>
									<td>{{ $role->users()->count() }}</td>
    								<td>
                                        @if (Auth::user()->ability('superadmin', 'role.edit'))
                                            <a href="{{ route('role.edit', $role->id) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                        @endif
                                        @if (Auth::user()->ability('superadmin', 'role.destroy'))
                                            <a href="{{ route('role.destroy', $role->id) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a>
                                        @endif
                                    </td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $roles, 'appended' => Request::all()])
				</div>
			</div>
		</div>
	</section>
@stop
