# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.12)
# Database: newnguyenha
# Generation Time: 2016-04-28 15:52:39 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table blog_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_tag`;

CREATE TABLE `blog_tag` (
  `blog_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`blog_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table blogs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `teaser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `hot` tinyint(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `background` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `path`, `level`, `type`, `active`, `position`, `icon`, `background`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Clothing','clothing',0,'-1-',1,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'Men\'s','men-s',1,'-1--2-',2,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'Women\'s','women-s',1,'-1--3-',2,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,'Suits','suits',2,'-1--2--4-',3,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(5,'Slacks','slacks',4,'-1--2--4--5-',4,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(6,'Jackets','jackets',4,'-1--2--4--6-',4,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(7,'Dresses','dresses',3,'-1--3--7-',3,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(8,'Skirts','skirts',3,'-1--3--8-',3,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(9,'Blouses','blouses',3,'-1--3--9-',3,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(10,'Evening Gorws','evening-gorws',7,'-1--3--7--10-',4,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(11,'Sun Dresses','sun-dresses',7,'-1--3--7--11-',4,1,1,0,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2014_10_12_000000_create_users_table',1),
	('2014_10_12_100000_create_password_resets_table',1),
	('2015_07_03_112021_entrust_setup_tables',1),
	('2015_07_23_051216_create_setting_table',1),
	('2015_07_28_070453_create_blogs_table',1),
	('2015_07_28_072304_create_tags_table',1),
	('2015_07_28_072620_create_blog_tag_table',1),
	('2015_07_30_071110_create_table_categories',1),
	('2015_08_03_062821_add_column_tags_table_Blog',1),
	('2015_11_08_172915_create_jobs_table',1),
	('2015_11_09_093640_alter_users_table_to_add_socialite_id',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permission_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'user.view','View','View user\'s info','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'user.create','Create','Create an user','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'user.edit','Edit','Edit user\'s info','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(4,'user.delete','Delete','Delete an user','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;

INSERT INTO `role_user` (`user_id`, `role_id`)
VALUES
	(1,1);

/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'superadmin','Super Admin','Super administrator role','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(2,'admin','Administrator','Administrator role','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	(3,'editor','Editor','Editor role','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `skype_1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `skype_2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `skype_3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `yahoo_1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `yahoo_2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `yahoo_3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `contact` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `js_codes` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `googleplus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `linkin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `logo`, `name`, `address`, `email_1`, `email_2`, `email_3`, `phone_1`, `phone_2`, `phone_3`, `skype_1`, `skype_2`, `skype_3`, `yahoo_1`, `yahoo_2`, `yahoo_3`, `short_description`, `description`, `contact`, `meta_title`, `meta_keyword`, `meta_description`, `js_codes`, `facebook`, `googleplus`, `twitter`, `linkin`, `youtube`)
VALUES
	(1,'','Nguyên Hà Tech','15/03 Ngọc Hồi, Q. Hoàng Mai, TP. Hà Nội','pureriver14@gmail.com','','','0934577886','','','ttmanh.ifi','','','','','','Chuyên tư vấn, thiết kế và xây dựng Website chuyên nghiệp','','','Chuyên tư vấn, thiết kế và xây dựng Website chuyên nghiệp :: NHT','tu van, thiet ke, xay dung webstie','Chuyên tư vấn, thiết kế và xây dựng Website chuyên nghiệp','','','','','','');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `facebook_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `github_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_facebook_id_unique` (`facebook_id`) USING BTREE,
  KEY `users_github_id_unique` (`github_id`) USING BTREE,
  KEY `users_google_id_unique` (`google_id`) USING BTREE,
  KEY `users_twitter_id_unique` (`twitter_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`, `name`, `nickname`, `avatar`, `phone`, `address`, `gender`, `active`, `remember_token`, `created_at`, `updated_at`, `facebook_id`, `github_id`, `google_id`, `twitter_id`)
VALUES
	(1,'admin@nguyenhats.com','$2y$10$8/50e.ESdZgHSBnoFUiaDunkPkg1KV1M0uJU77JVD925X8/h.cQVi','Administrator','Administrator','','0934577886','15/3 Ngọc Hồi, Hoàng Mai, Hà Nội',0,0,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','','','',''),
	(3,'rwalker@hotmail.com','oob79gorlp','Mr. Mallory Daniel V','Orrin Powlowski','04bbb17e5dbf92c3e845540e26acad44','1-541-608-8663x797','23706 Gusikowski Junction Apt. 921\nLake Baylee, AL 29807',0,1,'RLtkOMsSfF','2016-04-26 07:13:54','2016-04-26 07:13:54',NULL,NULL,NULL,''),
	(4,'harber.lorenza@yahoo.com','$2y$10$vlLYMYZ1R2rr5fr.TH8nROvrXZ0x3.LVvHthCQ5kaVJVWeerRapvK','Kristy Steuber','Amani Monahan III','e0f74437dd3c3a60000332bba3c849ba','1-218-710-8979x594','6021 Nayeli Key\nWest Kierashire, UT 69296',0,1,'z1k8WR02FJ','2016-04-26 07:16:02','2016-04-26 07:16:02',NULL,NULL,NULL,'');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
