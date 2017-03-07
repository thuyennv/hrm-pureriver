<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(Nht\Hocs\Users\User::class)->create([
			'email'    => 'info@nguyenhats.com',
			'password' => bcrypt('admin1234'),
			'name'     => 'Administrator',
			'nickname' => 'Administrator',
			'avatar'   => '',
			'phone'    => '0934577886',
			'address'  => '15/3 Ngọc Hồi, Hoàng Mai, Hà Nội',
			'gender'   => 0
		]);
    }
}
