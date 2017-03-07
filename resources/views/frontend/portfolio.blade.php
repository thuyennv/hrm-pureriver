@extends('frontend/layouts/master')
@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/subsite.css">
	<style type="text/css">
		.owl-nav {
			position: absolute;
			top: 48%;
			width: 100%;
		}
		.owl-prev {
			position: absolute;
			left: -30px;
			font-size: 30px;
			color: #ccc;
		}
		.owl-next {
			position: absolute;
			right: -30px;
			font-size: 30px;
			color: #ccc;
		}
	</style>
@stop

@section('headline')
	<h1 class="intro-heading">Dự án đã thực hiện</h1>
@stop

@section('main-content')
	<div class="row mb20">
		<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs12">
			<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><i class="fa fa-home"></i>
					<a itemprop="item" title="Trang chủ" href="/"><span itemprop="name">Trang chủ</span></a>
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="active">
					<span itemprop="item"><span itemprop="name">Dự án đã thực hiện</span></span>
				</li>
			</ol>
			<div class="row service-item-detail">
				<div class="col-md-7">
					<h2>Mytour</h2>
					<p>Mytour là một website chuyên trang về du lịch bao gồm rất nhiều những lĩnh vực nhỏ xoay quanh du lịch như
					đặt phòng khách sạn, đặt tour, đặt vé tàu, xe, máy bay... Ngoài ra còn các hệ thống backend vận hành phía sau
					nữa như HMS - Hotel Management System, PMS - Property Management System.</p>
					<p>Ngoại trừ hệ thống PMS thì hầu hết các thành phần chức năng trên Mytour đều có sự tham gia phát triển của
					các thành viên Nguyên Hà</p>
					<h4>Công nghệ sử dụng:</h4>
					<ul class="tech-list list-unstyled">
						<li><i class="fa fa-html5"></i></li>
						<li><i class="fa fa-css3"></i></li>
						<li><i class="fa fa-github"></i></li>
					</ul>
				</div>
				<div class="col-md-5">
					<div class="pjt-img-slider">
						<div><img src="/images/projects/screenshots/mytour1.jpg" alt="Mytour - Trang chủ"></div>
						<div><img src="/images/projects/screenshots/mytour2.jpg" alt="Mytour - Trang danh sách"></div>
						<div><img src="/images/projects/screenshots/mytour3.jpg" alt="Mytour - Trang chi tiết"></div>
					</div>
				</div>
			</div>
			<div class="row service-item-detail">
				<div class="col-md-7">
					<h2>Rapian</h2>
					<p>Rapian là nền tảng <b>thương mại điện tử đường phố</b> hoàn toàn miễn phí dành cho những người kinh doanh vừa và nhỏ có thể trực tiếp vận hành một website thương mại điện tử
					của riêng mình để hỗ trợ kinh doanh và quản lý dễ dàng hơn.</p>
					<p>Ngoài việc cung cấp 1 nền tảng về website bán hàng, trong tương lai Rapian sẽ mang đến cho người kinh doanh một hệ thống quản lý bán lẻ (Retail management system) đơn giản, mạnh mẽ cùng với đó là các ứng dụng mobile nhằm
					hỗ trợ người kinh doanh một cách tối đa nhất.</p>
					<!-- <p>Mục tiêu cốt lõi của Rapian là xây dựng lên một mạng lưới hàng ngàn người kinh doanh nhỏ lẻ trên khắp Việt Nam, từ những kiot nhỏ ở các chợ đầu mối tới các doanh nghiệp chuyên
					về thương mại điện tử có thể sử dụng Rapian để kinh doanh, quản lý. Từ mạng lưới này sẽ hình thành lên một hệ thống cực kỳ đa dạng các loại hàng hóa khiến cho việc mua bán online
					sẽ tương đồng với việc mua bán ngoài thực tế. Từ đây, việc kinh doanh của người kinh doanh sẽ đơn giản và nhanh chóng hơn, người tiêu dùng sẽ dễ dàng mua sắm và tìm kiếm sản phẩm hơn.</p> -->
					<h4>Công nghệ sử dụng:</h4>
					<ul class="tech-list list-unstyled">
						<li><i class="fa fa-html5"></i></li>
						<li><i class="fa fa-css3"></i></li>
						<li><i class="fa fa-github"></i></li>
					</ul>
				</div>
				<div class="col-md-5">
					<div class="pjt-img-slider">
						<div><img src="/images/projects/screenshots/rapian.jpg" alt="Rapian - Trang chủ"></div>
						<div><img src="/images/projects/screenshots/rapian2.jpg" alt="Rapian - Trang đăng ký"></div>
					</div>
				</div>
			</div>
			<div class="row service-item-detail">
				<div class="col-md-7">
					<h2>Queenwork</h2>
					<p>Queenwork là dự án về lĩnh vực tuyển dụng tập trung vào thị trường việc làm cho phái nữ.</p>
					<p>Sản phẩm có được sự đầu tư lớn về mặt hình ảnh và bộ nhận dạng thương hiệu, cùng với đó là hệ thống thông tin ứng viên đồ sộ và chất lượng, đồng thời cũng cung cấp nhiều thông tin về việc làm, tuyển dụng ở nhiều doanh nghiệp tại Việt Nam.</p>
					<h4>Công nghệ sử dụng:</h4>
					<ul class="tech-list list-unstyled">
						<li><i class="fa fa-html5"></i></li>
						<li><i class="fa fa-css3"></i></li>
						<li><i class="fa fa-github"></i></li>
					</ul>
				</div>
				<div class="col-md-5">
					<div class="pjt-img-slider">
						<div><img src="/images/projects/screenshots/queenwork2.jpg" alt="Queenwork - Trang ứng viên"></div>
						<div><img src="/images/projects/screenshots/queenwork.jpg" alt="Queenwork - Trang nhà tuyển dụng"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$(function() {
			$(".pjt-img-slider").owlCarousel({
				items: 1,
				center: true,
				nav: true,
				loop: true,
				lazyLoad: true,
				navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>']
			});
		});
	</script>
@stop
