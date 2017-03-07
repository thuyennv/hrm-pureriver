<?php

use Illuminate\Database\Seeder;

class DbSeedCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('categories')->insert([
			[
				'name'      =>'Tuyển dụng',
				'slug' 		=> 'recruitment',
				'parent_id' => 0,
				'path' 		=> '-1-',
				'level'     => 1,
				'active' 	=> 1,
				'type' 		=> 1
			],
			[
				'name'      =>'Blog',
				'slug' 		=> 'blog',
				'parent_id' => 0,
				'path' 		=> '-1-',
				'level'     => 1,
				'active' 	=> 1,
				'type' 		=> 1
			],
		]);
    }
}
