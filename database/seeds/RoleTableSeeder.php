<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('roles')->insert([
			[
				'name' => 'superadmin',
				'display_name' => 'The God',
				'description' => 'Powerful'
			],
			[
				'name' => 'moderator',
				'display_name' => 'Moderator',
				'description' => 'Moderator role'
			]
		]);
    }
}
