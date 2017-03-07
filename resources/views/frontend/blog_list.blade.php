@extends('frontend/layouts/master')
@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/subsite.css">
@stop

@section('headline')
	<h1 class="intro-heading">Bài viết - tin tức</h1>
@stop

@section('main-content')
	<div class="row mb20">
		<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs12">
			<div itemscope="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
				<ol class="breadcrumb">
					<li itemprop="itemListElement" itemtype="http://schema.org/ListItem">
						<i class="fa fa-home"></i>
						<a itemprop="item" href="/">Trang chủ</a>
					</li>
					<li itemprop="itemListElement" itemtype="http://schema.org/ListItem">
						<span itemprop="item"><span itemprop="name">Bài viết - tin tức</span></span>
					</li>
				</ol>
			</div>
			@if (count($features) > 2)
				<div class="row feature-blog">
					<div class="fblog-item col-md-8">
						<a class="blog-pic" href="{{ $features[0]->getUrl() }}" title="{{ $features[0]->title }}">
							<img src="{{ $features[0]->getThumbnail('lg_') }}" alt="{{ $features[0]->title }}">
						</a>
						<h3><a href="{{ $features[0]->getUrl() }}" title="{{ $features[0]->title }}">{{ str_limit($features[0]->title, 80) }}</a></h3>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="fblog-item col-md-12">
								<a class="blog-pic" href="{{ $features[1]->getUrl() }}" title="{{ $features[1]->title }}">
									<img src="{{ $features[1]->getThumbnail('lg_') }}" alt="{{ $features[1]->title }}">
								</a>
								<h3><a href="{{ $features[1]->getUrl() }}" title="{{ $features[1]->title }}">{{ str_limit($features[1]->title, 80) }}</a></h3>
							</div>
							<div class="fblog-item col-md-12">
								<a class="blog-pic" href="{{ $features[2]->getUrl() }}" title="{{ $features[2]->title }}">
									<img src="{{ $features[2]->getThumbnail('lg_') }}" alt="{{ $features[2]->title }}">
								</a>
								<h3><a href="{{ $features[2]->getUrl() }}" title="{{ $features[2]->title }}">{{ str_limit($features[2]->title, 80) }}</a></h3>
							</div>
						</div>
					</div>
				</div>
			@endif
			<div class="row">
				@forelse($blogs as $blog)
					<div class="blog-item col-md-3 col-sm-4 col-xs-12">
						<a class="blog-pic" href="{{ $blog->getUrl() }}" title="{{ $blog->title }}">
							<img src="{{ $blog->getThumbnail() }}" alt="{{ $blog->title }}">
						</a>
						<h3><a href="{{ $blog->getUrl() }}" title="{{ $blog->title }}">{{ str_limit($blog->title, 80) }}</a></h3>
						<p>{{ str_limit($blog->teaser, 80) }}</p>
					</div>
				@empty
					<h4 class="text-center">Website đang cập nhật bài viết, vui lòng quay lại sau :)</h4>
				@endforelse
			</div>
		</div>
	</div>
@stop
