@extends('frontend/layouts/master')
@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/subsite.css">
@stop

@section('headline')
	<h1 class="intro-heading">Tuyển dụng</h1>
@stop

@section('main-content')
	<div class="row mb20">
		<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs12">
			<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><i class="fa fa-home"></i>
					<a itemprop="item" title="Trang chủ" href="/"><span itemprop="name">Trang chủ</span></a>
				</li>
				<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="active">
					<span itemprop="item"><span itemprop="name">Tuyển dụng</span></span>
				</li>
			</ol>
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
                    <h4 class="text-center">Hiện tại Nguyên Hà chưa có nhu cầu bổ sung nhân sự!</h4>
                    <p class="text-center">Tuy nhiên, hãy giữ liên lạc nhé vì có thể chúng tôi sẽ muốn bổ sung thêm đồng đội vào 1 dịp nào đó khác đấy 😎</p>
                @endforelse
            </div>
		</div>
	</div>
@stop
