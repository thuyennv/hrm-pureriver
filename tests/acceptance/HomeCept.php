<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Visit homepage and read all content');
$I->amOnPage('/');
$I->seeInTitle('Chuyên tư vấn, thiết kế và xây dựng Website chuyên nghiệp :: NHT :: Nguyên Hà Tech');
$I->seeLink('Trang chủ', '/');
$I->seeLink('Dịch vụ', '/dich-vu');
$I->seeLink('Dự án', '/du-an');
$I->seeLink('Blog', '/blogs');
$I->seeLink('Tuyển dụng', '/tuyen-dung');
$I->seeLink('Về chúng tôi', '/ve-chung-toi');
$I->see('Cung cấp dịch vụ phát triển ứng dụng website');
$I->see('Dịch vụ', 'h2');
$I->see('Xây dựng và thiết kế website', 'h3');
$I->see('Tư vấn và triển khai giải pháp marketing', 'h3');
$I->see('Nghiên cứu và xây dựng nội dung', 'h3');
$I->see('Thiết kế nhận dạng thương hiệu', 'h3');
$I->see('Tư duy sản phẩm', 'h2');
$I->see('Tính ổn định', 'h3');
$I->see('Tối ưu hóa SEO', 'h3');
$I->see('Khả năng bảo trì', 'h3');
$I->see('Tối ưu hóa UI/UX', 'h3');
$I->see('Khả năng nâng cấp', 'h3');
$I->see('Hiệu năng cao', 'h3');
$I->see('Dự án nổi bật', 'h2');
$I->see('Các khách hàng', 'h2');
$I->see('Liên hệ', 'h2');
