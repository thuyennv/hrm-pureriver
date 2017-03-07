<!--header start-->
<header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
        <a href="{{ route('dashboard') }}" class="logo">
            {{ trans('admin/general.heading') }}
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <div class="top-nav clearfix">
        <span class="header-info" data-placement="bottom" data-toggle="tooltip" data-original-title="{{ in_array(Request::ip(), Config::get('allowable_ip_checkin')['allowable_ips']) ? 'IP hợp lệ' : 'IP không hợp lệ' }}">
            <i style="font-size: 20px;" class="fa fa-bolt {{ in_array(Request::ip(), Config::get('allowable_ip_checkin')['allowable_ips']) ? 'text-success' : 'text-warning' }}"></i>
            Địa chỉ truy cập hiện tại: <b class="text-danger" style="border-bottom: 1px dotted">{{ Request::ip() }}</b></span>
        <ul class="nav pull-right top-menu">
            <li id="header_notification_bar" class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-warning">3</span>
                </a>
                <ul class="dropdown-menu extended notification">
                    <li>
                        <p>Notifications</p>
                    </li>
                    <li>
                        <div class="alert alert-info clearfix">
                            <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                            <div class="noti-info">
                                <a href="#"> Server #1 overloaded.</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="alert alert-danger clearfix">
                            <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                            <div class="noti-info">
                                <a href="#"> Server #2 overloaded.</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="alert alert-success clearfix">
                            <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                            <div class="noti-info">
                                <a href="#"> Server #3 overloaded.</a>
                            </div>
                        </div>
                    </li>

                </ul>
            </li>
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img class="blog-image img-thumbnail" style="background: url('{{ Auth::user()->getAvatarPath() }}') center center no-repeat; height: 35px; width: 35px; padding: 0px; background-size: cover; display: inline;" />
                    <span class="username">{{ Auth::user()->nickname }}</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="{{ url('/admin/profile') }}"><i class="fa fa-suitcase"></i>{{ trans('general.profile') }}</a></li>
                    <li><a href="{{ url('/admin/password') }}"><i class="fa fa-lock"></i> Đổi mật khẩu</a></li>
                    <li><a href="{{ route('admin.logout') }}"><i class="fa fa-key"></i> {{ trans('general.logout') }}</a></li>
                </ul>
            </li>
        </ul>
        <!--search & user info end-->
    </div>
</header>
<!--header end-->
