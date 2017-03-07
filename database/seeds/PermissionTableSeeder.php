<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
   {
    	DB::table('permissions')->insert([
    		[
				'name' => 'admin',
				'display_name' => 'Administrator',
				'description' => 'Truy cập admin'
    		],
    		// User
    		[
				'name' => 'user.view',
				'display_name' => 'Xem',
				'description' => 'Xem User'
    		],
    		[
				'name' => 'user.create',
				'display_name' => 'Tạo mới',
				'description' => 'Tạo User'
			],
			[
				'name' => 'user.edit',
				'display_name' => 'Sửa',
				'description' => 'Sửa User'
			],
			[
				'name' => 'user.destroy',
				'display_name' => 'Xóa',
				'description' => 'Xóa User'
			],
			[
				'name' => 'user.grant',
				'display_name' => 'Phân quyền',
				'description' => 'Phân quyền User'
			],
			// Setting
			[
				'name' => 'setting.view',
				'display_name' => 'Xem',
				'description' => 'Xem Setting'
    		],
    		[
				'name' => 'setting.create',
				'display_name' => 'Tạo mới',
				'description' => 'Tạo Setting'
			],
			[
				'name' => 'setting.edit',
				'display_name' => 'Sửa',
				'description' => 'Sửa Setting'
			],
			[
				'name' => 'setting.destroy',
				'display_name' => 'Xóa',
				'description' => 'Xóa Setting'
			],
			// Category
			[
				'name' => 'category.view',
				'display_name' => 'Xem',
				'description' => 'Xem Category'
    		],
    		[
				'name' => 'category.create',
				'display_name' => 'Tạo mới',
				'description' => 'Tạo Category'
			],
			[
				'name' => 'category.edit',
				'display_name' => 'Sửa',
				'description' => 'Sửa Category'
			],
			[
				'name' => 'category.destroy',
				'display_name' => 'Xóa',
				'description' => 'Xóa Category'
			],
			// Blog
			[
				'name' => 'blog.view',
				'display_name' => 'Xem Blog',
				'description' => 'Xem Blog'
    		],
    		[
				'name' => 'blog.create',
				'display_name' => 'Tạo Blog',
				'description' => 'Tạo Blog'
			],
			[
				'name' => 'blog.edit',
				'display_name' => 'Sửa Blog',
				'description' => 'Sửa Blog'
			],
			[
				'name' => 'blog.destroy',
				'display_name' => 'Xóa Blog',
				'description' => 'Xóa Blog'
			],
            // Page
            [
                'name' => 'page.view',
                'display_name' => 'Xem Page',
                'description' => 'Xem Page'
            ],
            [
                'name' => 'page.create',
                'display_name' => 'Tạo Page',
                'description' => 'Tạo Page'
            ],
            [
                'name' => 'page.edit',
                'display_name' => 'Sửa Page',
                'description' => 'Sửa Page'
            ],
            [
                'name' => 'page.destroy',
                'display_name' => 'Xóa Page',
                'description' => 'Xóa Page'
            ],
		]);
   }
}
