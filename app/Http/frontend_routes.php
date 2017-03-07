<?php

/*
|--------------------------------------------------------------------------
| Frontend routes
|--------------------------------------------------------------------------
|
| Đây là file tổng hợp tất cả các routes khu vực frontend
|   - Các controllers bắt đầu với namespace Nht\Http\Controllers\Frontend
*/

Route::group(['namespace' => 'Frontend'], function() {

	Route::get('/', [
		'as'   => 'frontend.index',
		'uses' => 'HomeController@index'
	]);

	Route::get('/dich-vu', [
		'as'   => 'frontend.service',
		'uses' => 'HomeController@service'
	]);

	Route::get('/du-an', [
		'as'   => 'frontend.portfolio',
		'uses' => 'HomeController@portfolio'
	]);

	Route::get('/tuyen-dung', [
		'as'   => 'frontend.recruitment',
		'uses' => 'BlogController@recruitment'
	]);

	Route::get('/ve-chung-toi', [
		'as'   => 'frontend.about_us',
		'uses' => 'HomeController@aboutus'
	]);

	// Blog
	//
	Route::get('/blogs', [
		'as'   => 'frontend.blogs',
		'uses' => 'BlogController@index'
	]);
	Route::get('/blogs/{id}-{title}', [
	   	'as' => 'frontend.blog',
	   	'uses' => 'BlogController@show'
	]);
   	Route::get('/blogs/feature', 'BlogController@getFeatureBlogs');
   	Route::get('/danh-muc/{category}-{name}', [
        'as' => 'frontend.blogByCategory',
        'uses' => 'BlogController@category'
   	]);

   	Route::get('/tags/{tag}', 'BlogController@getTags');

   Route::get('/test', 'TestController@index');
   Route::post('/test', 'TestController@upload');

});
