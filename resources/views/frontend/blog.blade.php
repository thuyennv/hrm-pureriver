@extends('frontend/layouts/master')

@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/subsite.css">
@stop

@section('main-content')
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-8 detail-post" itemscope="article">
		<div class="crumb">
			<div itemscope="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
				<ol class="breadcrumb">
					<li itemprop="itemListElement" itemtype="http://schema.org/ListItem">
						<i class="fa fa-home"></i>
						<a itemprop="item" href="/">Trang chủ</a>
					</li>
					<li itemprop="itemListElement" itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="{{ route('frontend.blogByCategory', [$blog->category->id, $blog->category->slug]) }}">{{ $blog->category->name }}</a>
					</li>
					<li itemprop="itemListElement" itemtype="http://schema.org/ListItem">
						<span itemprop="item"><span itemprop="name">{{ $blog->title }}</span></span>
					</li>
				</ol>
			</div>
			<div class="clearfix"></div>
		</div>
		<h1 class="detail-title">{{ $blog->title }}</h1>
		<p class="blog-teaser">
			{{ $blog->teaser }}
		</p>
		<img src="{{ $blog->getThumbnail('lg_') }}" alt="{{ $blog->title }}" class="image">
		<div class="blog-content font-16">
			{!! $blog->content !!}
		</div>
		<br>
		<hr>
		<h2>Comments</h2>
		<div class="row">
			<div class="fb-like col-sm-12" data-share="true" data-show-faces="true"></div>
		</div>
		<div class="row">
			<div id="fb-root"></div>
			<div class="fb-comments col-sm-12" data-width="100%" data-href="{{ URL::current() }}" data-numposts="10"></div>
		</div>
	</div>
	<div class="col-md-2">&nbsp;</div>
@stop
@section('scripts')
	<script>
		window.fbAsyncInit = function() {
		 FB.init({
		   	appId      : '469135149934644',
		   	xfbml      : true,
		   	version    : 'v2.4'
		 });
		};

		(function(d, s, id){
		  	var js, fjs = d.getElementsByTagName(s)[0];
		  	if (d.getElementById(id)) {return;}
		  	js = d.createElement(s); js.id = id;
		  	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=469135149934644";
		  	fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
@stop
