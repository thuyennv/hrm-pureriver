@extends('frontend/layouts/master')
@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/subsite.css">
@stop

@section('headline')
	<h1 class="intro-heading">Dịch vụ của chúng tôi</h1>
@stop

@section('main-content')
	<div class="row mb20">
		<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs12">
			<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><i class="fa fa-home"></i>
					<a itemprop="item" title="Trang chủ" href="/"><span itemprop="name">Trang chủ</span></a>
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="active">
					<span itemprop="item"><span itemprop="name">Dịch vụ của chúng tôi</span></span>
				</li>
			</ol>
			<div class="row">
				<div class="col-md-7 col-sm-7">
					<div class="service-item-detail">
						<h2>Xây dựng và thiết kế website</h2>
						<p>Qua nhiều năm làm việc, cộng tác, xây dựng và phát triển các website thương mại điện tử lớn của Việt Nam như Vật Giá, Cực Rẻ, Rapian... cùng nhiều các
						website bán hàng khác nhau đã tích lũy cho chúng tôi rất nhiều kinh nghiệm trong lĩnh vực này. Bên cạnh việc thiết kế và xây dựng
						website, chúng tôi còn có thêm cả kinh nghiệm về triển khai nền tảng hạ tầng backend của hệ thống thương mại điện tử. Hay nói cách
						khác là ERP - Hệ thống hoạch định tài nguyên doanh nghiệp.</p>
						<p>Ngoài ra, chúng tôi còn có kinh nghiệm làm việc với nhiều website ở các lĩnh vực khác như tour du lịch, đặt phòng khách sạn,
						phim online, mạng xã hội... Với tất cả những kinh nghiệm đã tích lũy, chúng tôi có thể đảm bảo cho quý khách về một sản phẩm ổn định,
						chuẩn yêu cầu, mạnh mẽ và có hiệu năng cao nhất.</p>
					</div>
					<div class="service-item-detail">
						<h2>Phát triển ứng dụng điện thoại</h2>
						<p>Thời đại của smartphone đang ngày một phát triển mạnh mẽ, đi kèm với đó là nhu cầu sử dụng ứng dụng điện thoại là vô cùng to lớn. Chắc chắn là quý khách sẽ không
						muốn bỏ qua lượng khách hàng cực kỳ tiềm năng và đông đảo này.</p>
						<p>Từng có nhiều kinh nghiệm làm việc với các khách hàng lớn trong và ngoài nước, đội ngũ kỹ sư chuyên đảm nhận công việc xây dựng và phát triển ứng dụng điện thoại
						thông minh của Nguyên Hà sẽ luôn có những giải pháp tối ưu nhất cho yêu cầu của quý khách. Các dự án trên nền tảng smartphone của chúng tôi tập trung chủ yếu ở lĩnh
						vực thương mại điện tử, có tính ứng dụng lớn và lượng người dùng đông đảo. Tuy nhiên, phần lớn dự án của chúng tôi cũng tới từ nhiều lĩnh vực khác nữa.</p>
					</div>
					<div class="service-item-detail">
						<h2>Nghiên cứu và xây dựng nội dung</h2>
						<p>Một trong những điều băn khoăn nhất của các khách hàng khi sử dụng dịch vụ thiết kế Website của Nguyên Hà đấy là vấn về về dữ liệu sản phẩm
						bao gồm hình ảnh, nội dung mô tả, tin bài... Làm thế nào để hình ảnh sản phẩm khi đưa lên site phải thật chuyên nghiệp? Hay làm thế nào mà nội dung mô tả phải
						thật hấp dẫn, chuẩn SEO mà đồng thời cũng phải cung cấp thông tin trực quan nhất cho người mua hàng của mình? Nắm bắt được những trăn trở đó, chúng
						tôi đã xây dựng được một đội ngũ gồm những nhân viên có "tài viết lách" và nghiên cứu để hiểu về sản phẩm. Đa phần trong số đó đều đã từng làm việc
						hoặc xuất thân từ các trường đại học liên quan tới báo chí. Thêm nữa, nhóm cũng được dẫn dắt bởi những trưởng nhóm am hiểu về SEO chắc chắn sẽ
						thỏa mãn được rất nhiều yêu cầu từ các khách hàng của Nguyên Hà.</p>
						<p>Bên cạnh đó, Nguyên Hà cũng tích cực hợp tác với các đối tác cung cấp các dịch vụ SEO khác trong phạm vi cả nước để có thể cùng nhau san sẻ
						công việc, trợ giúp khách hàng một cách chuyên nghiệp và bài bản nhất cùng mức chi phí hợp lý nhất có thể.</p>
					</div>
					<div class="service-item-detail">
						<h2>Thiết kế và phát triển Game</h2>
						<p>Với sự phát triển vượt bậc các thế hệ trình duyệt với các công nghệ như HTML5, Javascript... mà
						việc làm Game trên nền tảng HTML5 đang phát triển rất nhanh. Với lợi thế về kinh nghiệm phát triển website, đội ngũ kỹ sư và họa sĩ của Nguyên Hà
						có thể đáp ứng được hầu hết các yêu cầu về lĩnh vực thiết kế và xây dựng Game. Hiện chúng tôi vẫn đang tiếp tục là đối tác
						tin cậy cho nhiều công ty chuyên làm về Game. Đặc biệt là các game ở thể loại giải trí, học tập.</p>
						<p>Một trong những đối tác trong nước lớn của chúng tôi là website ViOlympic của tập đoàn FPT với các Game về thể loại học tập, giáo dục.</p>
					</div>
				</div>
				<div id="process-circle" class="col-md-5 col-sm-5">
					<h2 class="text-center">Quy trình làm việc</h2>
					<div class="prc-item">
						<h3 class="text-center">Khảo sát nhu cầu</h3 class="text-center">
						<p>Chúng tôi sẽ trực tiếp liên hệ khách hàng để khảo sát nhu cầu và tiếp nhận thông tin dự án</p>
						<img src="/images/services/tiep_nhan_thong_tin.png" alt="Khảo sát nhu cầu">
					</div>
					<div class="prc-item">
						<h3 class="text-center">Phân tích yêu cầu</h3>
						<p>Chúng tôi sẽ tiến hành phân tích yêu cầu của khách và lên kế hoạch cho việc phát triển</p>
						<img src="/images/services/phan_tich_yeu_cau.png" alt="Phân tích yêu cầu">
					</div>
					<div class="prc-item">
						<h3 class="text-center">Triển khai</h3>
						<p>Chúng tôi bắt đầu triển khai dự án dựa trên các thông tin đã thu thập trong quá trình làm việc với khách hàng</p>
						<img src="/images/services/trien_khai_xay_dung.png" alt="Triển khai">
					</div>
					<div class="prc-item">
						<h3 class="text-center">Quản lý và báo cáo</h3>
						<p>Chúng tôi quản lý tiến độ và báo cáo với khách hàng thường kỳ nhằm đảm bảo dự án diễn ra đúng kế hoạch</p>
						<img src="/images/services/bao_cao_tien_do.png" alt="Quản lý và báo cáo">
					</div>
					<div class="prc-item">
						<h3 class="text-center">Nghiệm thu và bàn giao</h3>
						<p>Chúng tôi sẽ hoàn thiện dự án và bàn giao cho khách hàng sau đó tiến hành nghiệm thu và hỗ trợ vận hành.</p>
						<img src="/images/services/ban_giao_du_an.png" alt="Nghiệm thu và bàn giao">
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
