<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header page-scroll">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			@if($metadata->getLogo())
				<a id="logo" class="navbar-brand" href="{{ url('/') }}" style="background: url('{{ LOGO_SETTING.$metadata->getLogo() }}') center center no-repeat; background-size: 150px; width: 150px; height: 50px" title="{{ $metadata->getName() }}"></a>
			@else
				<a id="logo" class="navbar-brand" href="{{ url('/') }}" style="background: url('/images/logo.png') center center no-repeat; background-size: 150px; width: 150px; height: 50px" title="{{ $metadata->getName() }}"></a>
			@endif
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li class="{{ Request::is('/') ? 'active' : '' }}"><a title="Trang chủ" href="{{ route('frontend.index') }}">Trang chủ</a></li>
				<li class="{{ Request::is('dich-vu') ? 'active' : '' }}"><a title="Dịch vụ" href="{{ route('frontend.service') }}">Dịch vụ</a></li>
				<li class="{{ Request::is('du-an') ? 'active' : '' }}"><a title="Dự án" href="{{ route('frontend.portfolio') }}">Dự án</a></li>
				<li><a title="Blog" href="http://fsd14.com">Blog</a></li>
				<li class="{{ Request::is('/tuyen-dung') ? 'active' : '' }}"><a title="Tuyển dụng" href="{{ route('frontend.recruitment') }}">Tuyển dụng</a></li>
				<li class="{{ Request::is('/ve-chung-toi') ? 'active' : '' }}"><a title="Về chúng tôi" href="{{ route('frontend.about_us') }}">Về chúng tôi</a></li>
			 </ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>

 <!-- Header -->
 <header>
 	<!-- <div id="nht-fss" data-mesh-ambient="#3694d2" data-mesh-diffuse="#27ae60" data-light-ambient="#2c3e50" data-light-diffuse="#34495e"></div> -->
	<div id="particles-js">
		<div class="container">
			<div class="intro-text">
				@yield('headline')
			</div>
		</div>
	</div>
 </header>
