<?php
$I = new FunctionalTester($scenario);
$I->wantTo('view blogs');
$I->amOnPage('/blogs');
$I->seeInTitle('Bài viết - tin tức :: NHT :: Nguyên Hà Tech');
$I->see('Bài viết - tin tức', 'h1');
$I->see('Tin tức liên quan', 'h2');
$I->see('Website đang cập nhật bài viết, vui lòng quay lại sau :)', 'h2');
