<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

Warning - 2012-10-19 08:45:33 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 08:46:17 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 08:47:09 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 08:55:39 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:05:25 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Error - 2012-10-19 09:05:25 --> Error - Foreign keys on create_table() must specify a foreign key name in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\dbutil.php on line 461
Warning - 2012-10-19 09:06:58 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Error - 2012-10-19 09:06:58 --> Error - Foreign keys on create_table() must specify a foreign key name in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\dbutil.php on line 461
Warning - 2012-10-19 09:09:19 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:11:10 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:12:29 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Error - 2012-10-19 09:12:29 --> Error - Foreign keys on create_table() must specify a foreign key name in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\dbutil.php on line 461
Warning - 2012-10-19 09:19:18 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:20:48 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:21:25 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:25:36 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Error - 2012-10-19 09:25:36 --> Error - SQLSTATE[HY000]: General error: 1005 Can't create table 'e_commerce.users' (errno: 150) with query: "CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(15) NOT NULL,
	`password` varchar(100) NOT NULL,
	`first_name` varchar(25) NOT NULL,
	`last_name` varchar(25) NOT NULL,
	`date_of_birth` varchar(10) NOT NULL,
	`street` varchar(50) NOT NULL,
	`street_number` int(3) NOT NULL,
	`town` varchar(50) NOT NULL,
	`country_id` int(3) NOT NULL,
	`tel` varchar(20) NOT NULL,
	`email` varchar(45) NOT NULL,
	`role_id` int(2) NOT NULL,
	`confirmation_code` varchar(16) NOT NULL,
	`activated` boolean NOT NULL,
	`created_at` int(11) NOT NULL,
	`updated_at` int(11) NOT NULL,
	PRIMARY KEY `id` (`id`), 
	CONSTRAINT `constUsersCountries` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `constUsersRoles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) DEFAULT CHARACTER SET utf8;" in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\database\pdo\connection.php on line 175
Warning - 2012-10-19 09:26:09 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:26:13 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:26:17 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Error - 2012-10-19 09:26:17 --> Error - SQLSTATE[HY000]: General error: 1005 Can't create table 'e_commerce.users' (errno: 150) with query: "CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(15) NOT NULL,
	`password` varchar(100) NOT NULL,
	`first_name` varchar(25) NOT NULL,
	`last_name` varchar(25) NOT NULL,
	`date_of_birth` varchar(10) NOT NULL,
	`street` varchar(50) NOT NULL,
	`street_number` int(3) NOT NULL,
	`town` varchar(50) NOT NULL,
	`country_id` int(3) NOT NULL,
	`tel` varchar(20) NOT NULL,
	`email` varchar(45) NOT NULL,
	`role_id` int(2) NOT NULL,
	`confirmation_code` varchar(16) NOT NULL,
	`activated` boolean NOT NULL,
	`created_at` int(11) NOT NULL,
	`updated_at` int(11) NOT NULL,
	PRIMARY KEY `id` (`id`), 
	CONSTRAINT `constUsersCountries` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `constUsersRoles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) DEFAULT CHARACTER SET utf8;" in L:\Local Server\sites\sandbox\projet-web\fuel\core\classes\database\pdo\connection.php on line 175
Warning - 2012-10-19 09:32:21 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:34:13 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:36:48 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:36:55 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:45:17 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:49:21 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:55:08 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 09:57:59 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:01:06 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:01:27 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:04:41 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:06:17 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:06:47 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:18:13 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:21:22 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:21:40 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:23:02 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:24:07 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:24:12 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:25:40 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:26:47 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:31:05 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:34:15 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:37:49 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
Warning - 2012-10-19 10:38:39 --> Fuel\Core\Fuel::init - The configured locale en_US is not installed on your system.
