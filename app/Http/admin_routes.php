<?php

/*
|--------------------------------------------------------------------------
| Administrator routes
|--------------------------------------------------------------------------
|
| Đây là file tổng hợp tất cả các routes trong khu vực backend (admin)
|   - Các routes đều bắt đầu với /admin.
|   - Chú ý thêm permissions tại mỗi route nếu cần thiết.
|   - Các controllers bắt đầu với namespace Nht\Http\Controllers\Admin
|
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    /**
     * Admin auth page
     */
    Route::get('login', [
        'as'   => 'admin.login',
        'uses' => 'AuthController@getLogin',
        'middleware' => 'guest:admin'
        ]);

    Route::post('login', [
        'as'   => 'admin.doLogin',
        'uses' => 'AuthController@postLogin',
        'middleware' => 'guest:admin'
        ]);

    Route::get('logout', [
        'as'   => 'admin.logout',
        'uses' => 'AuthController@getLogout'
        ]);

    Route::group(['middleware' => 'acl:admin'], function() {
        /**
         * Dashboard
         */
        Route::get('dashboard', [
            'as' => 'dashboard',
            'uses' => 'AuthController@dashboard'
        ]);

        Route::get('checkin', [
            'as' => 'checkin',
            'uses' => 'WorkdayController@store'
        ]);

        Route::get('recess', [
            'as' => 'recess',
            'uses' => 'WorkdayController@recess'
        ]);

        Route::post('recess', [
            'uses' => 'WorkdayController@postRecess'
        ]);

        Route::get('recess/{user}/{status}', [
            'as' => 'recess.update',
            'uses' => 'WorkdayController@updateRecess',
            // 'permissions' => 'user.handle_recess'
        ]);

        Route::get('checkin/count', [
            'as' => 'checkin.count',
            'uses' => 'WorkdayController@count'
        ]);

        /**
         * Profile setting
         */
        Route::get('password', [
            'as'   => 'user.password',
            'uses' => 'UserController@password'
        ]);

        Route::post('password', [
            'as' => 'user.changePassword',
            'uses' => 'UserController@changePassword'
        ]);

        Route::get('profile', [
            'as' => 'user.profile',
            'uses' => 'UserController@profile'
        ]);

        Route::post('profile', [
            'as' => 'user.updateProfile',
            'uses' => 'UserController@updateProfile'
        ]);

        /**
         * Users module
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', [
                'as'         => 'user.index',
                'uses'       => 'UserController@index',
                'permissions' => 'user.view',
            ]);

            Route::get('create', [
                'as'         => 'user.create',
                'uses'       => 'UserController@create',
                'permissions' => 'user.create',
            ]);

            Route::post('/', [
                'as'         => 'user.store',
                'uses'       => 'UserController@store',
                'permissions' => 'user.create',
            ]);

            Route::get('{users}/edit', [
                'as'         => 'user.edit',
                'uses'       => 'UserController@edit',
                'permissions' => 'user.edit',
            ]);

            Route::post('{user}', [
                'as'         => 'user.update',
                'uses'       => 'UserController@update',
                'permissions' => 'user.edit',
            ]);

            Route::get('{user}', [
                'as'         => 'user.destroy',
                'uses'       => 'UserController@destroy',
                'permissions' => 'user.destroy',
            ]);

            Route::get('{user}/active', [
                'as'         => 'user.active',
                'uses'       => 'UserController@active',
                'permissions' => 'user.edit'
            ]);

            Route::get('{user}/workdays', [
                'as'         => 'user.workdays',
                'uses'       => 'WorkdayController@view',
                'permission' => 'user.view_workday'
            ]);

            Route::get('{user}/salaries', [
                'as'         => 'user.salaries',
                'uses'       => 'SalaryController@view',
                'permission' => 'user.view_salary'
            ]);
        });

        /**
         * Roles module
         */
        Route::group(['prefix' => 'roles'], function() {
            Route::get('/', [
                'as'          => 'role.index',
                'uses'        => 'RoleController@index',
                'permissions' => 'role.view',
            ]);

            Route::get('create', [
                'as'          => 'role.create',
                'uses'        => 'RoleController@create',
                'permissions' => 'role.create',
            ]);

            Route::post('/', [
                'as'          => 'role.store',
                'uses'        => 'RoleController@store',
                'permissions' => 'role.create',
            ]);

            Route::get('{role}/edit', [
                'as'          => 'role.edit',
                'uses'        => 'RoleController@edit',
                'permissions' => 'role.edit',
            ]);

            Route::post('{role}', [
                'as'          => 'role.update',
                'uses'        => 'RoleController@update',
                'permissions' => 'role.edit',
            ]);

            Route::get('{role}', [
                'as'          => 'role.destroy',
                'uses'        => 'RoleController@destroy',
                'permissions' => 'role.destroy',
            ]);
        });

        /**
         * Permissions module
         */
        Route::group(['prefix' => 'permissions'], function() {
            Route::get('/', [
                'as'          => 'permission.index',
                'uses'        => 'PermissionController@index'
            ]);

            Route::get('create', [
                'as'          => 'permission.create',
                'uses'        => 'PermissionController@create'
            ]);

            Route::post('/', [
                'as'          => 'permission.store',
                'uses'        => 'PermissionController@store'
            ]);

            Route::get('{permission}/edit', [
                'as'          => 'permission.edit',
                'uses'        => 'PermissionController@edit'
            ]);

            Route::post('{permission}', [
                'as'          => 'permission.update',
                'uses'        => 'PermissionController@update'
            ]);

            Route::get('{permission}', [
                'as'          => 'permission.destroy',
                'uses'        => 'PermissionController@destroy'
            ]);
        });

        /**
         * Settings module
         */
        Route::group(['prefix' => 'settings'], function() {
            Route::get('website', [
                'as'          => 'website.edit',
                'uses'        => 'SettingController@edit',
                'permissions' => 'setting',
            ]);

            Route::post('website', [
                'as'        => 'website.update',
                'uses'  => 'SettingController@update',
                'permissions' => 'setting',
            ]);

            Route::get('metadata', [
                'as'   => 'metadata.show',
                'uses' => 'SettingController@metadata',
                'permissions' => 'setting',
            ]);

            Route::post('metadata', [
                'as'   => 'metadata.post.edit',
                'uses' => 'SettingController@postMetadata',
                'permissions' => 'setting',
            ]);

            Route::get('social', [
                'as'   => 'social.show',
                'uses' => 'SettingController@social',
                'permissions' => 'setting',
            ]);

            Route::post('social', [
                'as'   => 'social.post.edit',
                'uses' => 'SettingController@postSocial',
                'permissions' => 'setting',
            ]);
        });

        /**
         * Menu module
         */
        Route::group(['prefix' => 'menus'], function() {
            Route::get('/', [
                'as'          => 'menu.index',
                'uses'        => 'MenuController@index',
                'permissions' => 'menu.view',
            ]);

            Route::get('create', [
                'as'          => 'menu.create',
                'uses'        => 'MenuController@create',
                'permissions' => 'menu.create',
            ]);

            Route::post('/', [
                'as' => 'menu.store',
                'uses' => 'MenuController@store',
                'permissions' => 'menu.create',
            ]);

            Route::get('{menu}/edit', [
                'as'          => 'menu.edit',
                'uses'        => 'MenuController@edit',
                'permissions' => 'menu.edit',
            ]);

            Route::post('{menu}', [
                'as'          => 'menu.update',
                'uses'        => 'MenuController@update',
                'permissions' => 'menu.edit',
            ]);

            Route::get('{menu}', [
                'as'          => 'menu.destroy',
                'uses'        => 'MenuController@destroy',
                'permissions' => 'menu.destroy',
            ]);
            Route::get('{menu}/active', [
                'as'          => 'menu.active',
                'uses'        => 'MenuController@active',
                'permissions' => 'menu.active',
            ]);
        });


        /**
         * Page module
         */
        Route::group(['prefix' => 'pages'], function() {
            Route::get('/', [
                'as'          => 'page.index',
                'uses'        => 'PageController@index',
                'permissions' => 'page.view',
            ]);

            Route::get('create', [
                'as'          => 'page.create',
                'uses'        => 'PageController@create',
                'permissions' => 'page.create',
            ]);

            Route::post('/', [
                'as' => 'page.store',
                'uses' => 'PageController@store',
                'permissions' => 'page.create',
            ]);

            Route::get('{page}/edit', [
                'as'          => 'page.edit',
                'uses'        => 'PageController@edit',
                'permissions' => 'page.edit',
            ]);

            Route::post('{page}', [
                'as'          => 'page.update',
                'uses'        => 'PageController@update',
                'permissions' => 'page.edit',
            ]);

            Route::get('{page}', [
                'as'          => 'page.destroy',
                'uses'        => 'PageController@destroy',
                'permissions' => 'page.destroy',
            ]);
            Route::get('{page}/active', [
                'as'          => 'page.active',
                'uses'        => 'PageController@active',
                'permissions' => 'page.active',
            ]);
        });

        /**
         * Blog module
         */
        Route::group(['prefix' => 'blogs'], function() {
            Route::get('/', [
                'as'          => 'blog.index',
                'uses'        => 'BlogController@index',
                'permissions' => 'blog.view',
            ]);

            Route::get('create', [
                'as'          => 'blog.create',
                'uses'        => 'BlogController@create',
                'permissions' => 'blog.create',
            ]);

            Route::post('/', [
                'as' => 'blog.store',
                'uses' => 'BlogController@store',
                'permissions' => 'blog.create',
            ]);

            Route::get('{blog}/edit', [
                'as'          => 'blog.edit',
                'uses'        => 'BlogController@edit',
                'permissions' => 'blog.edit',
            ]);

            Route::post('{blog}', [
                'as'          => 'blog.update',
                'uses'        => 'BlogController@update',
                'permissions' => 'blog.edit',
            ]);

            Route::get('{blog}', [
                'as'          => 'blog.destroy',
                'uses'        => 'BlogController@destroy',
                'permissions' => 'blog.destroy',
            ]);
            Route::get('{blog}/active', [
                'as'          => 'blog.active',
                'uses'        => 'BlogController@active',
                'permissions' => 'blog.active',
            ]);

            Route::get('{blog}/hot', [
                'as'          => 'blog.hot',
                'uses'        => 'BlogController@hot',
                'permissions' => 'blog.hot',
            ]);
        });

        /**
         * Route categories
         */
        Route::group(['prefix' => 'categories'], function() {

            Route::get('/', [
                'as'          => 'category.index',
                'uses'        => 'CategoryController@index',
                'permissions' => 'category.view'
            ]);

            Route::get('/create',  [
                'as'          => 'admin.category.create',
                'uses'        => 'CategoryController@create',
                'permissions' => 'category.create'
            ]);

            Route::post('/create', [
                'as'          => 'admin.category.store',
                'uses'        =>'CategoryController@store',
                'permissions' => 'category.create'
            ]);

            Route::get('{id}/edit',  [
                'as'          => 'admin.category.edit',
                'uses'        => 'CategoryController@edit',
                'permissions' => 'category.edit'
            ]);

            Route::post('{id}/edit', [
                'as'          => 'admin.category.update',
                'uses'        =>'CategoryController@update',
                'permissions' => 'category.edit'
            ]);

            Route::get('{id}/active', [
                'as'          => 'admin.category.active',
                'uses'        => 'CategoryController@active',
                'permissions' => 'category.active'
            ]);

            Route::get('{id}/delete', [
                'as'          => 'admin.category.destroy',
                'uses'        => 'CategoryController@destroy',
                'permissions' => 'category.destroy'
            ]);
        });
    });
});
