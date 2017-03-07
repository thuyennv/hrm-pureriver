<!--sidebar start-->
<aside>
	<div id="sidebar" class="nav-collapse">
		<!-- sidebar menu start-->
		<div class="leftside-navigation">
			<ul class="sidebar-menu" id="nav-accordion">
				<li class="{{ Request::is("admin/dashboard") ? 'active' : '' }}">
					<a href="{{ route('dashboard') }}" title="{{ trans('admin/general.modules.dashboard') }}">
						<i class="fa fa-dashboard"></i>
						{{ trans('admin/general.modules.dashboard') }}
					</a>
				</li>
				@if(Entrust::ability('superadmin', 'setting.view'))
					<li class="sub-menu">
						<a href="javascript:;" class="{{ Request::is("admin/settings*") ? 'active' : '' }}">
							<i class="fa fa-cog"></i>
							{{ trans('admin/general.modules.setting') }}
						</a>
						<ul class="sub">
							<li class="{{ Request::is("admin/settings/website") ? 'active' : '' }}">
								<a href="{{ route('website.edit') }}">{{ trans('admin/general.modules.site') }}</a>
							</li>
							<li class="{{ Request::is("admin/settings/metadata") ? 'active' : '' }}">
								<a href="{{ route('metadata.show') }}">{{ trans('admin/general.modules.metadata') }}</a>
							</li>
							<li class="{{ Request::is("admin/settings/social") ? 'active' : '' }}">
								<a href="{{ route('social.show') }}">{{ trans('admin/general.modules.social') }}</a>
							</li>
						</ul>
					</li>
				@endif
				@if(Entrust::ability('superadmin', 'user.view'))
					<li class="sub-menu">
						<a href="javascript:;" class="{{ (Request::is("admin/users*") or Request::is("admin/roles*") or Request::is("admin/permissions*")) ? 'active' : '' }}">
							<i class="fa fa-user"></i>
							{{ trans('admin/general.modules.user') }}
						</a>
						<ul class="sub">
							@if(Entrust::ability('superadmin', 'user.view'))
								<li class="{{ Request::is("admin/users*") ? 'active' : '' }}">
									<a href="{{ route('user.index') }}">{{ trans('admin/general.modules.users') }}</a>
								</li>
							@endif
							@if(Entrust::ability('superadmin', 'role.view'))
								<li class="{{ Request::is("admin/roles*") ? 'active' : '' }}">
									<a href="{{ route('role.index') }}">{{ trans('admin/general.modules.roles') }}</a>
								</li>
                                @if (Auth::user()->id == 1)
    								<li class="{{ Request::is("admin/permissions*") ? 'active' : '' }}">
    									<a href="{{ route('permission.index') }}">{{ trans('admin/general.modules.permissions') }}</a>
    								</li>
                                @endif
							@endif
						</ul>
					</li>
				@endif
				@if(Entrust::ability('superadmin', 'category.view'))
					<li>
						<a href="{{ route('category.index') }}" class="{{ Request::is("admin/categories*") ? 'active' : '' }}">
							<i class="fa fa-align-center"></i> {{ trans('admin/general.modules.category') }}</a>
					</li>
				@endif
                @if(Entrust::ability('superadmin', 'page.view'))
                    <li class="{{ Request::is("admin/pages*") ? 'active' : '' }}">
                        <a href="{{ route('page.index') }}" class="{{ Request::is("admin/pages*") ? 'active' : '' }}">
                            <i class="fa fa-file-code-o"></i>Quản lý trang</a>
                    </li>
                @endif
				@if(Entrust::ability('superadmin', 'blog.view'))
					<li class="{{ Request::is("admin/blogs*") ? 'active' : '' }}">
						<a href="{{ route('blog.index') }}" class="{{ Request::is("admin/blogs*") ? 'active' : '' }}">
							<i class="fa fa-user"></i>Quản lý bài viết</a>
					</li>
				@endif
			</ul>
		</div>
		<!-- sidebar menu end-->
	</div>
</aside>
<!--sidebar end-->
