-- Click&Go MySQL Manager 4.2.5 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5,	'2014_10_12_000000_create_users_table',	1),
(6,	'2014_10_12_100000_create_password_resets_table',	1),
(7,	'2017_07_16_031903_create_orders_table',	2);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_addr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_id_unique` (`order_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `orders` (`id`, `user_id`, `order_id`, `phone`, `full_addr`, `location`, `amount`, `remember_token`, `created_at`, `updated_at`) VALUES
(4,	1,	'xTXjfBd1EmnWeAstKIsGHKDwE5105hnb',	'1146544506',	'38 Moasset elnoor street',	'Giza Governorate, Egypt',	'150',	NULL,	'2017-07-16 03:50:10',	'2017-07-16 03:50:10'),
(5,	1,	'y6Rzk6JYrabXliIgOsFeTrrCrL5gUgme',	'1146544506',	'38 Moasset elnoor street',	'El-Zaytoun, El-Zaytoun El-Bahareya, Cairo Governorate, Egypt',	'250',	NULL,	'2017-07-16 03:51:05',	'2017-07-16 03:51:05');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_user_id_unique` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `user_id`, `email`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Eslam Jekso',	'10207792549531998',	'',	'https://graph.facebook.com/v2.9/10207792549531998/picture?type=normal',	'8V9A7oyXKC2cDYWQtPF6mgiY0Cf479IiAeZhe5xNeW6d5Rgbp6NO9LKMtsba',	'2017-07-15 21:11:24',	'2017-07-15 21:11:24'),
(2,	'Mahmoud Abd EL-satar',	'1585758684775991',	'',	'https://graph.facebook.com/v2.9/1585758684775991/picture?type=normal',	NULL,	'2017-07-15 21:12:01',	'2017-07-15 21:12:01');

-- 2017-07-16 04:14:10
