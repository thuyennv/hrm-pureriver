@extends('frontend/layouts/master')
@section('headline')
	<div class="intro-heading">Cung cấp dịch vụ phát triển ứng dụng website</div>
	<div class="intro-lead-in">
		Mục tiêu giá trị của chúng tôi là kết nối lâu dài trở thành đối tác tin cậy, giúp quý khách hàng an tâm
		các vấn đề về sản phẩm, website.
	</div>
@stop
@section('main-content')
	<div id="intro" class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<h1 class="text-primary">Nguyên Hà</h1>
					<p class="text_desc">
						Chúng tôi là một công ty công nghệ chuyên cung cấp các giải pháp, dịch vụ nền tảng website.
						Với nhiều năm kinh nghiệm phát triển những hệ thống website E-Commerce lớn như Vatgia, Mytour và rất nhiều
						 dự án website trải rộng khắp các lĩnh vực khiến chúng tôi tự tin vào khả năng đáp ứng của mình.
					</p>
				</div>
				<div class="col-md-6 col-sm-6 text-center">
					<img src="/images/world_map.jpg" title="Trụ sở chính">
				</div>
			</div>
		</div>
	</div>
	<div id="service-list" class="row home-blk">
		<div class="home-blk-header">
			<h2>Dịch vụ</h2>
			<p>Our services</p>
		</div>
		<ul class="list-unstyled mg0">
			<!-- Row1 -->
			<li class="service-block">
				<div>
					<div class="service-item service-intro">
						<h3>Thiết kế và xây dựng website</h3>
						<p>Với kinh nghiệm nhiều năm trong lĩnh vực thiết kế và xây dựng website, chúng tôi có thể đáp ứng được nhiều yêu cầu từ mọi lĩnh vực kinh doanh của quý khách hàng.</p>
					</div>
					<div class="service-item arrow-left">
						<img src="/images/xay_dung_va_thiet_ke_website.png" alt="Xây dựng và thiết kế website">
					</div>
				</div>
				<div>
					<div class="service-item arrow-right">
						<img src="/images/nghien_cuu_va_xay_dung_noi_dung.png" alt="Nghiên cứu và xây dựng nội dung">
					</div>
					<div class="service-item service-intro">
						<h3>Nghiên cứu và xây dựng nội dung</h3>
						<p>Với đội ngũ partner đông đảo và trải ở nhiều mảng khác nhau như quay video - chụp ảnh sản phẩm, viết bài chuẩn SEO... chúng tôi có thể cung cấp các dịch vụ nội dung tốt nhất.</p>
					</div>
				</div>
			</li>
			<li class="service-block">
				<div>
					<div class="service-item service-intro">
						<h3>Phát triển ứng dụng điện thoại</h3>
						<p>Với đội ngũ lập trình viên giàu kinh nghiệm, chúng tôi có thể xây dựng và phát triển các ứng dụng điện thoại trên nền tảng hệ điều hành Android và IOS</p>
					</div>
					<div class="service-item arrow-left">
						<img src="/images/tu_van_va_trien_khai_giai_phap_marketing.png" alt="Tư vấn và triển khai giải pháp marketing">
					</div>
				</div>
				<div>
					<div class="service-item arrow-right">
						<img src="/images/thiet_ke_nhan_dang_thuong_hieu.png" alt="Thiết kế nhận dạng thương hiệu">
					</div>
					<div class="service-item service-intro">
						<h3>Thiết kế và phát triển Game HTML5</h3>
						<p>Từng có kinh nghiệm làm outsourcing Game cho các thị trường Việt, Mỹ, Nhật... chúng tôi có thể đáp ứng được nhu cầu của quý khách hàng về lĩnh vực thiết kế Game trên nền tảng HTML5.</p>
					</div>
				</div>
			</li>
		</ul>
	</div>
	<div class="row home-blk" id="product-mindset">
		<div class="home-blk-header">
			<h2>Tư duy sản phẩm</h2>
			<p>Product mindset</p>
		</div>
		<div class="col-md-10 col-md-offset-1">
			<div class="col-md-5 col-sm-12 col-xs-12">
				<img src="/images/launch-web1.jpg" alt="startup website" style="width: 100%">
			</div>
			<div class="col-md-7 col-sm-12 col-xs-12">
				<p class="text_desc">Tất cả dự án chúng tôi đã phát triển đều được xây dựng hoàn toàn thủ công từ đầu tới cuối
				dựa trên framework Laravel. Mã nguồn của sản phẩm đều được viết theo chuẩn chung, đảm bảo tính rõ ràng,
				mạch lạc và khả năng tối ưu hóa mã nguồn cao. Việc này nhằm hạn chế các lỗi phát sinh trong quá trình hoạt động.
				Chính điều này làm cho những dự án chúng tôi xây dựng đều đảm bảo 6 yếu tố:</p>
				<ul class="list-unstyled" id="prd_mindsets">
					<div class="row">
						<li class="col-md-4 col-sm-4 col-xs-4">
							<span class="prd_img_wrap"><i class="prd_img stability"></i></span>
							<h3>Tính ổn định</h3>
						</li>
						<li class="col-md-4 col-sm-4 col-xs-4">
							<span class="prd_img_wrap"><i class="prd_img seo"></i></span>
							<h3>Tối ưu hóa SEO</h3>
						</li>
						<li class="col-md-4 col-sm-4 col-xs-4">
							<span class="prd_img_wrap"><i class="prd_img maintain"></i></span>
							<h3>Khả năng bảo trì</h3>
						</li>
						<li class="col-md-4 col-sm-4 col-xs-4">
							<span class="prd_img_wrap"><i class="prd_img uiux"></i></span>
							<h3>Tối ưu hóa UI/UX</h3>
						</li>
						<li class="col-md-4 col-sm-4 col-xs-4">
							<span class="prd_img_wrap"><i class="prd_img upgrade"></i></span>
							<h3>Khả năng nâng cấp</h3>
						</li>
						<li class="col-md-4 col-sm-4 col-xs-4">
							<span class="prd_img_wrap"><i class="prd_img performance"></i></span>
							<h3>Hiệu năng cao</h3>
						</li>
					</div>
				</ul>
			</div>
		</div>
	</div>
	<div class="row home-blk">
		<div class="home-blk-header">
			<h2>Dự án nổi bật</h2>
			<p>Feature projects</p>
		</div>
		<div id="home-slider" class="owl-carousel owl-theme">
			<div class="item">
				<img src="/images/projects/rapian.jpg" alt="Rapian.com">
				<p>Rapian.com</p>
			</div>
			<div class="item">
				<img src="/images/projects/queenwork.jpg" alt="Queenwork.com">
				<p>Queenwork.com</p>
			</div>
			<div class="item">
				<img src="/images/projects/giaca.jpg" alt="Giaca.org">
				<p>Giá cả</p>
			</div>
			<div class="item">
				<img src="/images/projects/dulichthanglong.jpg" alt="Du lịch Thăng Long">
				<p>Du lịch Thăng Long</p>
			</div>
			<div class="item">
				<img src="/images/projects/gim.jpg" alt="Gim">
				<p>Gim.vn</p>
			</div>
			<div class="item">
				<img src="/images/projects/gdtq.jpg" alt="Giao dịch Trung Quốc">
				<p>Giao dịch Trung Quốc</p>
			</div>
			<div class="item">
				<img src="/images/projects/vtvgo.jpg" alt="VTVGo">
				<p>VTVGo</p>
			</div>
			<div class="item">
				<img src="/images/projects/cucre.jpg" alt="Cực rẻ">
				<p>Cực rẻ</p>
			</div>
		</div>
	</div>
	<div class="row home-blk">
		<div class="home-blk-header">
			<h2>Các khách hàng</h2>
			<p>Our clients</p>
		</div>
		<ul class="list-unstyled mg0" id="clients">
			<li><img src="/images/clients/vnp.png" alt="VNP Group"></li>
			<li><img src="/images/clients/mytour.png" alt="Mytour"></li>
			<li><img src="/images/clients/giaodichtrungquoc.png" alt="Giao dịch trung quốc"></li>
			<li><img src="/images/clients/vtvgo.png" alt="VTVGo"></li>
			<li><img src="/images/clients/queenwork.png" alt="Queenwork"></li>
			<li><img src="/images/clients/giaca.png" alt="Giá cả"></li>
			<li><img src="/images/clients/noichocolate.png" alt="Nồi Chocolate"></li>
		</ul>
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$(function() {
			$("#home-slider").owlCarousel({
				items: 3,
				center: true,
				loop: true,
				margin:10,
				autoPlay: true,
				lazyLoad: true
			});
		});
	</script>
@stop
