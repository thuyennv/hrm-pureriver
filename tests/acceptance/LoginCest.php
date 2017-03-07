<?php


class LoginCest
{
    // tests
    public function accessAdminArea(AcceptanceTester $I)
    {
        $I->am('Stranger');
        $I->wantTo('access administrator\'s area');

        $I->amOnPage('/admin/dashboard');
        $I->seeResponseCodeIs(403);
    }

    public function loginWithInvalidCredentials(AcceptanceTester $I)
    {
        $I->am('Site owner');
        $I->wantTo('login to administrator area with invalid credentials');
        $I->lookForwardTo('perform administrative tasks');

        $I->amOnPage('/admin/login');
        $I->fillField('email', 'invalid@nguyenhats.com');
        $I->fillField('password', 'invalid');
        $I->click('Đăng nhập');
        $I->see('Tài khoản không đúng', '.text-danger');

        $I->seeCurrentUrlEquals('/admin/login');
    }

    public function loginWithValidCredentials(AcceptanceTester $I)
    {
        $I->am('Site owner');
        $I->wantTo('login to administrator area with valid credentials');
        $I->lookForwardTo('perform administrative tasks');

        $I->amOnPage('/admin/login');
        $I->fillField('email', 'admin@nguyenhats.com');
        $I->fillField('password', 'admin1234');
        $I->click('Đăng nhập');

        $I->seeCurrentUrlEquals('/admin/dashboard');
    }
}
