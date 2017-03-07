<?php

class HomeControllerTest extends TestCase {

	public function testVisitHomePage()
	{
		$this->visit('/')
			->assertResponseOk();
	}

	public function testVisitHomePageAndHasTitle()
	{
		$this->visit('/')
			->see('Cung cấp dịch vụ phát triển ứng dụng website');
	}

	public function testVisitHomePageAndHasSubTitle()
	{
		$this->visit('/')
			->see('Mục tiêu giá trị của chúng tôi là kết nối lâu dài trở thành đối tác tin cậy, giúp quý khách hàng an tâm
		các vấn đề về sản phẩm, website.');
	}

	public function testSeePathOfMenuHomePage()
	{
		$this->visit('/')
			->click('Trang chủ')
			->seePageIs('/');
	}

	public function testSeePathOfMenuService()
	{
		$this->visit('/')
			->click('Dịch vụ')
			->seePageIs('/dich-vu');
	}

	public function testSeePathOfMenuPortfolio()
	{
		$this->visit('/')
			->click('Dự án')
			->seePageIs('/du-an');
	}
}
