<!-- footer -->
<div id="contact" class="row">
	<div id="map" class="hidden-xs"></div>
	<div class="col-md-4 col-md-offset-1" id="contact-info">
		<div class="home-blk">
			<div class="home-blk-header col-md-12 col-sm-6">
				<h2>Liên hệ</h2>
				<p>Get in touch</p>
			</div>
			<ul class="list-unstyled col-md-12 col-sm-6">
				<p><i class="fa fa-map-marker"></i> {{ $metadata->getAddress() }}</p>
				<p><i class="fa fa-phone-square"></i> {{ $metadata->getPhone_1() }}</p>
				@if ($metadata->getPhone_2())
					<p><i class="fa fa-phone-square"></i> {{ $metadata->getPhone_2() }}</p>
				@endif
				<p><i class="fa fa-envelope"></i> {{ $metadata->getEmail_1() }} </p>
				@if ($metadata->getEmail_2())
					<p><i class="fa fa-envelope"></i> {{ $metadata->getEmail_2() }} </p>
				@endif
			</ul>
		</div>
	</div>
</div>
<div id="footer" class="row">
	<div class="container">
		<div class="row">
			<div class="col-sm-2" style="overflow: hidden">
				<h3 id="wrap-logo-bot"><a id="logo-bot" href="{{ url('/') }}" style="background: url('/images/logo_nguyenha.svg') center center no-repeat; background-size: 150px; width: 130px; height: 130px" title="{{ $metadata->getName() }}"></a></h3>
			</div>
			<div class="col-sm-6">
				<ul class="list-unstyled">
					<li><h4>{{ $metadata->getName() }}</h4></li>
					<li>Trụ sở chính: {{ $metadata->getAddress() }}</li>
					<li>Email: {{ $metadata->getEmail_1() }}</li>
					<li>Phone: {{ $metadata->getPhone_1() }}</li>
				</ul>
			</div>
			<div class="col-sm-4">
				<h4><span>Kết nối với chúng tôi tại</span></h4>
				<ul class="social-list list-unstyled">
					<li><a href="{{ $metadata->getFacebook() | 'https://www.facebook.com/nguyenhatech/' }}" class="fa fa-facebook-square" title="facebook.com/nguyenhatech"></a></li>
					<li><a href="#" class="fa fa-twitter-square"></a></li>
				</ul>
				<p id="copyright">Copyright © {{ date('Y') }} Nguyen Ha Jsc. All rights reserved.</p>
			</div>
		</div>
	</div>
</div>
