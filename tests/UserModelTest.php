<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
// use Nht\Hocs\Users\User;

class UserModelTest extends TestCase {

	use DatabaseMigrations, DatabaseTransactions;

	public function testGetId()
	{
		$user = factory(Nht\Hocs\Users\User::class)->make([
			'id' => 1
		]);
		$this->assertEquals(1, $user->getId());
	}

	public function testGetPassword()
	{
		Hash::shouldReceive('make')->once()->andReturn('HashedFooBar');
		$user = factory(Nht\Hocs\Users\User::class)->make();
		$this->assertEquals('HashedFooBar', $user->getPassword());
	}

	public function testGetName()
	{
		$user = factory(Nht\Hocs\Users\User::class)->make(['name' => 'AlvinTran']);
		$this->assertEquals('AlvinTran', $user->getName());
	}

	public function testGetAvatarAndReturnDefault()
	{
		$expected = '/images/profiles/lock_thumb.png';
		$user = factory(Nht\Hocs\Users\User::class)->make(['avatar' => 'notfound.jpg']);
		$this->assertEquals($expected, $user->getAvatarPath());
	}

	public function testGetAvatarAndReturnPathOfAvatar()
	{
		$expected = '/uploads/users/sm_2015_11_29_61a8c22215.jpeg';
		$user = factory(Nht\Hocs\Users\User::class)->make(['avatar' => '2015_11_29_61a8c22215.jpeg']);
		$this->assertEquals($expected, $user->getAvatarPath());
	}

	public function testGetUrlOfAuthor()
	{
		$expected = '/tac-gia/1-alvin-tran';
		$user = factory(Nht\Hocs\Users\User::class)->make(['id' => 1, 'nickname' => 'Alvin Trần']);
		$this->assertTrue(strpos($user->getUrlOfAuthor(), $expected) > 0);
	}

	public function testGetStatusOfUser()
	{
		$user = factory(Nht\Hocs\Users\User::class)->make(['active' => 1]);
		$this->assertTrue($user->getActive());
	}
}
