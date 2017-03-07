<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	@include('frontend/includes/metadata')
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,500,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link href="/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/authentication.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="text-center">{{ $metadata->getMetaTitle() . " . " . $metadata->getName() }}</h1>
			<div class="col-sm-4 col-sm-offset-4" id="auth-form">
				@include('notifications')
				@yield('content')
			</div>
		</div>
	</div>
<!-- javascript -->
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
@yield('script')
{!! $metadata->getJsCodes() !!}
</body>
</html>
