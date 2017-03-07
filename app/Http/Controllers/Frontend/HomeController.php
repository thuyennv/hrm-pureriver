<?php

namespace Nht\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use Nht\Http\Controllers\Frontend\FrontendController;
use Nht\Hocs\Blogs\BlogRepository;

class HomeController extends FrontendController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
      return view('frontend/index');
	}

	public function service()
	{
		return view('frontend/service');
	}

	public function portfolio()
	{
		return view('frontend/portfolio');
	}

	public function blogs()
	{
		return view('frontend/blog');
	}

	public function recruitment()
	{
		return view('frontend/recruitment');
	}

	public function aboutus()
	{
		return view('frontend/about_us');
	}
}
