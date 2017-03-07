@extends('frontend/layouts/master')
@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/subsite.css">
@stop

@section('headline')
	<h1 class="intro-heading">Về chúng tôi</h1>
@stop

@section('main-content')
	<div class="row mb20">
		<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs12">
			<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><i class="fa fa-home"></i>
					<a itemprop="item" title="Trang chủ" href="/"><span itemprop="name">Trang chủ</span></a>
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="active">
					<span itemprop="item"><span itemprop="name">Về chúng tôi</span></span>
				</li>
			</ol>
			<div class="row">
				<h4 class="text-center">Công ty cổ phần thương mại và dịch vụ Nguyên Hà</h4>
				<p>
					Chúng tôi là một công ty công nghệ chuyên cung cấp các giải pháp, dịch vụ nền tảng website. Với nhiều năm kinh nghiệm phát triển những hệ thống website E-Commerce lớn như Vatgia, Mytour và rất nhiều dự án website trải rộng khắp các lĩnh vực khiến chúng tôi tự tin vào khả năng đáp ứng của mình.
				</p>
			</div>
		</div>
	</div>
@stop
