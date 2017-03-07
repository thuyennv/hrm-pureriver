<?php

/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
|
| Đây là file tổng hợp tất cả các routes liên quan tới việc authenticate khu vực frontend
|   - Các routes đều bắt đầu với /api.
|   - Các controllers bắt đầu với namespace Nht\Http\Controllers\Api
*/

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function() {
	Route::get('/tags', [
		'as'   => 'tags',
		'uses' => 'TagController@getTags'
	]);

    /**
     * API for Editor
     */
    Route::get('editor/browse', [
        'as' => 'editor.browse',
        'uses' => 'EditorController@browse'
    ]);

    Route::post('editor/upload', [
        'as' => 'editor.upload',
        'uses' => 'EditorController@upload'
    ]);
});
