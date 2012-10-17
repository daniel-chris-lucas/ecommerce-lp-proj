-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2012 at 04:56 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7RC1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `characteristics`
--

CREATE TABLE IF NOT EXISTS `characteristics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `iso` char(2) NOT NULL,
  `iso3` char(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=250 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso`, `iso3`) VALUES
(1, 'Afghanistan', 'AF', 'AFG'),
(2, 'Åland Islands', 'AX', 'ALA'),
(3, 'Albania', 'AL', 'ALB'),
(4, 'Algeria', 'DZ', 'DZA'),
(5, 'American Samoa', 'AS', 'ASM'),
(6, 'Andorra', 'AD', 'AND'),
(7, 'Angola', 'AO', 'AGO'),
(8, 'Anguilla', 'AI', 'AIA'),
(9, 'Antarctica', 'AQ', 'ATA'),
(10, 'Antigua and Barbuda', 'AG', 'ATG'),
(11, 'Argentina', 'AR', 'ARG'),
(12, 'Armenia', 'AM', 'ARM'),
(13, 'Aruba', 'AW', 'ABW'),
(14, 'Australia', 'AU', 'AUS'),
(15, 'Austria', 'AT', 'AUT'),
(16, 'Azerbaijan', 'AZ', 'AZE'),
(17, 'Bahamas', 'BS', 'BHS'),
(18, 'Bahrain', 'BH', 'BHR'),
(19, 'Bangladesh', 'BD', 'BGD'),
(20, 'Barbados', 'BB', 'BRB'),
(21, 'Belarus', 'BY', 'BLR'),
(22, 'Belgium', 'BE', 'BEL'),
(23, 'Belize', 'BZ', 'BLZ'),
(24, 'Benin', 'BJ', 'BEN'),
(25, 'Bermuda', 'BM', 'BMU'),
(26, 'Bhutan', 'BT', 'BTN'),
(27, 'Bolivia, Plurinational State of', 'BO', 'BOL'),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES'),
(29, 'Bosnia and Herzegovina', 'BA', 'BIH'),
(30, 'Botswana', 'BW', 'BWA'),
(31, 'Bouvet Island', 'BV', 'BVT'),
(32, 'Brazil', 'BR', 'BRA'),
(33, 'British Indian Ocean Territory', 'IO', 'IOT'),
(34, 'Brunei Darussalam', 'BN', 'BRN'),
(35, 'Bulgaria', 'BG', 'BGR'),
(36, 'Burkina Faso', 'BF', 'BFA'),
(37, 'Burundi', 'BI', 'BDI'),
(38, 'Cambodia', 'KH', 'KHM'),
(39, 'Cameroon', 'CM', 'CMR'),
(40, 'Canada', 'CA', 'CAN'),
(41, 'Cape Verde', 'CV', 'CPV'),
(42, 'Cayman Islands', 'KY', 'CYM'),
(43, 'Central African Republic', 'CF', 'CAF'),
(44, 'Chad', 'TD', 'TCD'),
(45, 'Chile', 'CL', 'CHL'),
(46, 'China', 'CN', 'CHN'),
(47, 'Christmas Island', 'CX', 'CXR'),
(48, 'Cocos (Keeling) Islands', 'CC', 'CCK'),
(49, 'Colombia', 'CO', 'COL'),
(50, 'Comoros', 'KM', 'COM'),
(51, 'Congo', 'CG', 'COG'),
(52, 'Congo, the Democratic Republic of the', 'CD', 'COD'),
(53, 'Cook Islands', 'CK', 'COK'),
(54, 'Costa Rica', 'CR', 'CRI'),
(55, 'Côte d''Ivoire', 'CI', 'CIV'),
(56, 'Croatia', 'HR', 'HRV'),
(57, 'Cuba', 'CU', 'CUB'),
(58, 'Curaçao', 'CW', 'CUW'),
(59, 'Cyprus', 'CY', 'CYP'),
(60, 'Czech Republic', 'CZ', 'CZE'),
(61, 'Denmark', 'DK', 'DNK'),
(62, 'Djibouti', 'DJ', 'DJI'),
(63, 'Dominica', 'DM', 'DMA'),
(64, 'Dominican Republic', 'DO', 'DOM'),
(65, 'Ecuador', 'EC', 'ECU'),
(66, 'Egypt', 'EG', 'EGY'),
(67, 'El Salvador', 'SV', 'SLV'),
(68, 'Equatorial Guinea', 'GQ', 'GNQ'),
(69, 'Eritrea', 'ER', 'ERI'),
(70, 'Estonia', 'EE', 'EST'),
(71, 'Ethiopia', 'ET', 'ETH'),
(72, 'Falkland Islands (Malvinas)', 'FK', 'FLK'),
(73, 'Faroe Islands', 'FO', 'FRO'),
(74, 'Fiji', 'FJ', 'FJI'),
(75, 'Finland', 'FI', 'FIN'),
(76, 'France', 'FR', 'FRA'),
(77, 'French Guiana', 'GF', 'GUF'),
(78, 'French Polynesia', 'PF', 'PYF'),
(79, 'French Southern Territories', 'TF', 'ATF'),
(80, 'Gabon', 'GA', 'GAB'),
(81, 'Gambia', 'GM', 'GMB'),
(82, 'Georgia', 'GE', 'GEO'),
(83, 'Germany', 'DE', 'DEU'),
(84, 'Ghana', 'GH', 'GHA'),
(85, 'Gibraltar', 'GI', 'GIB'),
(86, 'Greece', 'GR', 'GRC'),
(87, 'Greenland', 'GL', 'GRL'),
(88, 'Grenada', 'GD', 'GRD'),
(89, 'Guadeloupe', 'GP', 'GLP'),
(90, 'Guam', 'GU', 'GUM'),
(91, 'Guatemala', 'GT', 'GTM'),
(92, 'Guernsey', 'GG', 'GGY'),
(93, 'Guinea', 'GN', 'GIN'),
(94, 'Guinea-Bissau', 'GW', 'GNB'),
(95, 'Guyana', 'GY', 'GUY'),
(96, 'Haiti', 'HT', 'HTI'),
(97, 'Heard Island and McDonald Islands', 'HM', 'HMD'),
(98, 'Holy See (Vatican City State)', 'VA', 'VAT'),
(99, 'Honduras', 'HN', 'HND'),
(100, 'Hong Kong', 'HK', 'HKG'),
(101, 'Hungary', 'HU', 'HUN'),
(102, 'Iceland', 'IS', 'ISL'),
(103, 'India', 'IN', 'IND'),
(104, 'Indonesia', 'ID', 'IDN'),
(105, 'Iran, Islamic Republic of', 'IR', 'IRN'),
(106, 'Iraq', 'IQ', 'IRQ'),
(107, 'Ireland', 'IE', 'IRL'),
(108, 'Isle of Man', 'IM', 'IMN'),
(109, 'Israel', 'IL', 'ISR'),
(110, 'Italy', 'IT', 'ITA'),
(111, 'Jamaica', 'JM', 'JAM'),
(112, 'Japan', 'JP', 'JPN'),
(113, 'Jersey', 'JE', 'JEY'),
(114, 'Jordan', 'JO', 'JOR'),
(115, 'Kazakhstan', 'KZ', 'KAZ'),
(116, 'Kenya', 'KE', 'KEN'),
(117, 'Kiribati', 'KI', 'KIR'),
(118, 'Korea, Democratic People''s Republic of', 'KP', 'PRK'),
(119, 'Korea, Republic of', 'KR', 'KOR'),
(120, 'Kuwait', 'KW', 'KWT'),
(121, 'Kyrgyzstan', 'KG', 'KGZ'),
(122, 'Lao People''s Democratic Republic', 'LA', 'LAO'),
(123, 'Latvia', 'LV', 'LVA'),
(124, 'Lebanon', 'LB', 'LBN'),
(125, 'Lesotho', 'LS', 'LSO'),
(126, 'Liberia', 'LR', 'LBR'),
(127, 'Libya', 'LY', 'LBY'),
(128, 'Liechtenstein', 'LI', 'LIE'),
(129, 'Lithuania', 'LT', 'LTU'),
(130, 'Luxembourg', 'LU', 'LUX'),
(131, 'Macao', 'MO', 'MAC'),
(132, 'Macedonia, the former Yugoslav Republic of', 'MK', 'MKD'),
(133, 'Madagascar', 'MG', 'MDG'),
(134, 'Malawi', 'MW', 'MWI'),
(135, 'Malaysia', 'MY', 'MYS'),
(136, 'Maldives', 'MV', 'MDV'),
(137, 'Mali', 'ML', 'MLI'),
(138, 'Malta', 'MT', 'MLT'),
(139, 'Marshall Islands', 'MH', 'MHL'),
(140, 'Martinique', 'MQ', 'MTQ'),
(141, 'Mauritania', 'MR', 'MRT'),
(142, 'Mauritius', 'MU', 'MUS'),
(143, 'Mayotte', 'YT', 'MYT'),
(144, 'Mexico', 'MX', 'MEX'),
(145, 'Micronesia, Federated States of', 'FM', 'FSM'),
(146, 'Moldova, Republic of', 'MD', 'MDA'),
(147, 'Monaco', 'MC', 'MCO'),
(148, 'Mongolia', 'MN', 'MNG'),
(149, 'Montenegro', 'ME', 'MNE'),
(150, 'Montserrat', 'MS', 'MSR'),
(151, 'Morocco', 'MA', 'MAR'),
(152, 'Mozambique', 'MZ', 'MOZ'),
(153, 'Myanmar', 'MM', 'MMR'),
(154, 'Namibia', 'NA', 'NAM'),
(155, 'Nauru', 'NR', 'NRU'),
(156, 'Nepal', 'NP', 'NPL'),
(157, 'Netherlands', 'NL', 'NLD'),
(158, 'New Caledonia', 'NC', 'NCL'),
(159, 'New Zealand', 'NZ', 'NZL'),
(160, 'Nicaragua', 'NI', 'NIC'),
(161, 'Niger', 'NE', 'NER'),
(162, 'Nigeria', 'NG', 'NGA'),
(163, 'Niue', 'NU', 'NIU'),
(164, 'Norfolk Island', 'NF', 'NFK'),
(165, 'Northern Mariana Islands', 'MP', 'MNP'),
(166, 'Norway', 'NO', 'NOR'),
(167, 'Oman', 'OM', 'OMN'),
(168, 'Pakistan', 'PK', 'PAK'),
(169, 'Palau', 'PW', 'PLW'),
(170, 'Palestinian Territory, Occupied', 'PS', 'PSE'),
(171, 'Panama', 'PA', 'PAN'),
(172, 'Papua New Guinea', 'PG', 'PNG'),
(173, 'Paraguay', 'PY', 'PRY'),
(174, 'Peru', 'PE', 'PER'),
(175, 'Philippines', 'PH', 'PHL'),
(176, 'Pitcairn', 'PN', 'PCN'),
(177, 'Poland', 'PL', 'POL'),
(178, 'Portugal', 'PT', 'PRT'),
(179, 'Puerto Rico', 'PR', 'PRI'),
(180, 'Qatar', 'QA', 'QAT'),
(181, 'Réunion', 'RE', 'REU'),
(182, 'Romania', 'RO', 'ROU'),
(183, 'Russian Federation', 'RU', 'RUS'),
(184, 'Rwanda', 'RW', 'RWA'),
(185, 'Saint Barthélemy', 'BL', 'BLM'),
(186, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', 'SHN'),
(187, 'Saint Kitts and Nevis', 'KN', 'KNA'),
(188, 'Saint Lucia', 'LC', 'LCA'),
(189, 'Saint Martin (French part)', 'MF', 'MAF'),
(190, 'Saint Pierre and Miquelon', 'PM', 'SPM'),
(191, 'Saint Vincent and the Grenadines', 'VC', 'VCT'),
(192, 'Samoa', 'WS', 'WSM'),
(193, 'San Marino', 'SM', 'SMR'),
(194, 'Sao Tome and Principe', 'ST', 'STP'),
(195, 'Saudi Arabia', 'SA', 'SAU'),
(196, 'Senegal', 'SN', 'SEN'),
(197, 'Serbia', 'RS', 'SRB'),
(198, 'Seychelles', 'SC', 'SYC'),
(199, 'Sierra Leone', 'SL', 'SLE'),
(200, 'Singapore', 'SG', 'SGP'),
(201, 'Sint Maarten (Dutch part)', 'SX', 'SXM'),
(202, 'Slovakia', 'SK', 'SVK'),
(203, 'Slovenia', 'SI', 'SVN'),
(204, 'Solomon Islands', 'SB', 'SLB'),
(205, 'Somalia', 'SO', 'SOM'),
(206, 'South Africa', 'ZA', 'ZAF'),
(207, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS'),
(208, 'South Sudan', 'SS', 'SSD'),
(209, 'Spain', 'ES', 'ESP'),
(210, 'Sri Lanka', 'LK', 'LKA'),
(211, 'Sudan', 'SD', 'SDN'),
(212, 'Suriname', 'SR', 'SUR'),
(213, 'Svalbard and Jan Mayen', 'SJ', 'SJM'),
(214, 'Swaziland', 'SZ', 'SWZ'),
(215, 'Sweden', 'SE', 'SWE'),
(216, 'Switzerland', 'CH', 'CHE'),
(217, 'Syrian Arab Republic', 'SY', 'SYR'),
(218, 'Taiwan, Province of China', 'TW', 'TWN'),
(219, 'Tajikistan', 'TJ', 'TJK'),
(220, 'Tanzania, United Republic of', 'TZ', 'TZA'),
(221, 'Thailand', 'TH', 'THA'),
(222, 'Timor-Leste', 'TL', 'TLS'),
(223, 'Togo', 'TG', 'TGO'),
(224, 'Tokelau', 'TK', 'TKL'),
(225, 'Tonga', 'TO', 'TON'),
(226, 'Trinidad and Tobago', 'TT', 'TTO'),
(227, 'Tunisia', 'TN', 'TUN'),
(228, 'Turkey', 'TR', 'TUR'),
(229, 'Turkmenistan', 'TM', 'TKM'),
(230, 'Turks and Caicos Islands', 'TC', 'TCA'),
(231, 'Tuvalu', 'TV', 'TUV'),
(232, 'Uganda', 'UG', 'UGA'),
(233, 'Ukraine', 'UA', 'UKR'),
(234, 'United Arab Emirates', 'AE', 'ARE'),
(235, 'United Kingdom', 'GB', 'GBR'),
(236, 'United States', 'US', 'USA'),
(237, 'United States Minor Outlying Islands', 'UM', 'UMI'),
(238, 'Uruguay', 'UY', 'URY'),
(239, 'Uzbekistan', 'UZ', 'UZB'),
(240, 'Vanuatu', 'VU', 'VUT'),
(241, 'Venezuela, Bolivarian Republic of', 'VE', 'VEN'),
(242, 'Viet Nam', 'VN', 'VNM'),
(243, 'Virgin Islands, British', 'VG', 'VGB'),
(244, 'Virgin Islands, U.S.', 'VI', 'VIR'),
(245, 'Wallis and Futuna', 'WF', 'WLF'),
(246, 'Western Sahara', 'EH', 'ESH'),
(247, 'Yemen', 'YE', 'YEM'),
(248, 'Zambia', 'ZM', 'ZMB'),
(249, 'Zimbabwe', 'ZW', 'ZWE');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mailsubscribers`
--

CREATE TABLE IF NOT EXISTS `mailsubscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `type` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `migration` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`type`, `name`, `migration`) VALUES
('app', 'default', '001_create_countries'),
('app', 'default', '002_create_roles'),
('app', 'default', '003_create_users'),
('app', 'default', '004_create_orders'),
('app', 'default', '005_create_orderproducts'),
('app', 'default', '006_create_mailsubscribers'),
('app', 'default', '007_create_options'),
('app', 'default', '008_create_categories'),
('app', 'default', '009_create_products'),
('app', 'default', '010_create_ratings'),
('app', 'default', '011_create_characteristics'),
('app', 'default', '012_create_images');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `value` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE IF NOT EXISTS `orderproducts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `rating` float NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `note` int(2) NOT NULL,
  `description` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'regular'),
(2, 'moderator'),
(3, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
  `order_id` int(11) NOT NULL,
  `confirmation_code` varchar(16) NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
