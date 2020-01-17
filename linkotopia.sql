-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2016 at 06:52 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `linkotopia`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE IF NOT EXISTS `adminusers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `password` varchar(127) NOT NULL,
  `title` varchar(127) NOT NULL,
  `first_name` varchar(127) NOT NULL,
  `last_name` varchar(127) NOT NULL,
  `company` varchar(127) NOT NULL,
  `address` varchar(127) NOT NULL,
  `city` varchar(127) NOT NULL,
  `state` varchar(127) NOT NULL,
  `zip` varchar(127) NOT NULL,
  `country_id` varchar(127) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type` enum('super','editor','author') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`id`, `email`, `password`, `title`, `first_name`, `last_name`, `company`, `address`, `city`, `state`, `zip`, `country_id`, `created_at`, `updated_at`, `type`, `status`) VALUES
(9, 'xx', 'xx', 'Mr.', 'David', 'Stamford', '', '', '', '', '', '237', '2011-10-19 00:00:00', '2011-10-19 00:00:00', 'super', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `age`
--

CREATE TABLE IF NOT EXISTS `age` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `age_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `age`
--

INSERT INTO `age` (`id`, `age_name`) VALUES
(1, ' Senior Citizen (65+)'),
(2, '21+'),
(3, '19+ '),
(5, '18+'),
(10, '13+ and above'),
(11, '3 -12 years old'),
(12, 'Any');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`) VALUES
(7, 'Christmas'),
(8, 'Diwali'),
(9, 'News Years'),
(10, 'Halloween'),
(11, 'Family'),
(12, 'Music'),
(13, 'Arts & Theatre'),
(14, 'Sports'),
(15, 'Weekly event'),
(16, 'Conference'),
(17, 'School'),
(18, 'Formals'),
(19, 'Concert'),
(20, 'West Indian'),
(21, 'Filipino'),
(22, 'Tamil'),
(23, 'Hindi'),
(24, 'Punjabi ');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `contents_id` int(10) NOT NULL,
  `comment` text NOT NULL,
  `date_time_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `users_id`, `contents_id`, `comment`, `date_time_created`) VALUES
(1, 9, 40, 'xxzxzxzxz', '2016-01-22 05:31:22'),
(2, 9, 42, 'vcvcvx', '2016-01-22 05:42:59'),
(3, 9, 42, 'gfgfgfg', '2016-01-22 05:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `content_type` enum('text/html','link') NOT NULL,
  `content` text NOT NULL,
  `shared_contents_id` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` date NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `users_id`, `content_type`, `content`, `shared_contents_id`, `date_created`, `date_updated`, `status`) VALUES
(28, 9, 'link', 'http://mozarbazaar.com/', 0, '2015-12-16', '0000-00-00', 'active'),
(29, 9, 'link', 'http://mozarbazaar.com/', 0, '2015-12-16', '0000-00-00', 'active'),
(30, 9, 'text/html', 'cxcxcxcxcxc', 0, '2015-12-16', '0000-00-00', 'active'),
(31, 9, 'link', 'https://kat.cr/', 0, '2015-12-16', '0000-00-00', 'active'),
(32, 9, 'text/html', 'https://kat.cr/	', 0, '2015-12-22', '0000-00-00', 'active'),
(33, 9, 'link', 'https://kat.cr/', 0, '2015-12-22', '0000-00-00', 'active'),
(40, 9, '', '  \r\n   <table class="table v-middle">\r\n        <tr>\r\n            <td colspan="2" align="left">\r\n               <b>Event Name</b><br />\r\n                432424            </td>\r\n        \r\n        </tr>\r\n        <tr>\r\n            <td colspan="2" align="left">\r\n               <b>Price</b><br />\r\n                432424.00            </td>\r\n        \r\n        </tr>\r\n        <tr>\r\n             <td valign="top">\r\n                  <fieldset>\r\n                    <legend>When?</legend>\r\n                    <table>\r\n                           <tr>\r\n                              <td>\r\n                               Start Date<br />\r\n                                2015-12-23                              </td>\r\n                           </tr>\r\n                           <tr>\r\n                              <td nowrap="nowrap">\r\n                                Start Time<br />\r\n                                \r\n                                1:0 AM                                \r\n                              </td>\r\n                           </tr>\r\n                            <tr>\r\n                              <td>\r\n                               End Date<br />\r\n                                2015-12-22 \r\n                              </td>\r\n                           </tr>\r\n                           <tr>\r\n                              <td nowrap="nowrap">\r\n                                End Time<br />\r\n                                \r\n                               1:0 AM                                \r\n                              </td>\r\n                           </tr>\r\n                            <tr>\r\n                             <td>\r\n                             Timezone<br />\r\n                                                        Newfoundland Time (NT)                        </td>\r\n                      </tr>\r\n             \r\n                    </table>\r\n                  </fieldset>\r\n                    \r\n             </td>\r\n             \r\n             <td valign="top">\r\n                   <fieldset>\r\n                    <legend>Where?</legend>\r\n                    <table>\r\n                           <tr>\r\n                              <td>\r\n                              Venue Name<br />\r\n                               34324243\r\n                              </td>\r\n                           </tr>\r\n                           <tr>\r\n                              <td>\r\n                                Venue Post Code<br />\r\n                                43434                              </td>\r\n                           </tr>\r\n                    </table>\r\n                  </fieldset>\r\n             </td>\r\n        \r\n        \r\n         </tr>\r\n         <tr>\r\n              <td> Category<br />\r\n                                                          West Indian                            \r\n                    </td>\r\n                    <td align="left">Age <br />\r\n                                  \r\n                                                        21+                      </td>      \r\n         </tr>\r\n         <tr>\r\n             <td colspan="2">\r\n               Description<br /> \r\n               34343243232321             </td>\r\n         </tr>\r\n         <tr>\r\n            <td colspan="2">\r\n                 <table>\r\n                      <tr>\r\n                          <td>Event Picture</td><td> \r\n                                                        <img src="../events_images/9_4.jpg" style="width:100px;" />\r\n                                                     </td>\r\n                      </tr>\r\n                   </table>\r\n            </td>\r\n         \r\n         </tr> \r\n        \r\n  </td>\r\n </tr>\r\n</table>', 0, '2015-12-30', '0000-00-00', 'active'),
(41, 9, 'text/html', 'xzxzxzxx', 0, '2015-12-30', '0000-00-00', 'active'),
(42, 9, '', '  \r\n   <table class="table v-middle">\r\n        <tr>\r\n            <td colspan="2" align="left">\r\n               <b>Event Name</b><br />\r\n                432424            </td>\r\n        \r\n        </tr>\r\n        <tr>\r\n            <td colspan="2" align="left">\r\n               <b>Price</b><br />\r\n                432424.00            </td>\r\n        \r\n        </tr>\r\n        <tr>\r\n             <td valign="top">\r\n                  <fieldset>\r\n                    <legend>When?</legend>\r\n                    <table>\r\n                           <tr>\r\n                              <td>\r\n                               Start Date<br />\r\n                                2016-02-25                              </td>\r\n                           </tr>\r\n                           <tr>\r\n                              <td nowrap="nowrap">\r\n                                Start Time<br />\r\n                                \r\n                                1:0 AM                                \r\n                              </td>\r\n                           </tr>\r\n                            <tr>\r\n                              <td>\r\n                               End Date<br />\r\n                                2015-12-22 \r\n                              </td>\r\n                           </tr>\r\n                           <tr>\r\n                              <td nowrap="nowrap">\r\n                                End Time<br />\r\n                                \r\n                               1:0 AM                                \r\n                              </td>\r\n                           </tr>\r\n                            <tr>\r\n                             <td>\r\n                             Timezone<br />\r\n                                                        Newfoundland Time (NT)                        </td>\r\n                      </tr>\r\n             \r\n                    </table>\r\n                  </fieldset>\r\n                    \r\n             </td>\r\n             \r\n             <td valign="top">\r\n                   <fieldset>\r\n                    <legend>Where?</legend>\r\n                    <table>\r\n                           <tr>\r\n                              <td>\r\n                              Venue Name<br />\r\n                               34324243\r\n                              </td>\r\n                           </tr>\r\n                           <tr>\r\n                              <td>\r\n                                Venue Post Code<br />\r\n                                43434                              </td>\r\n                           </tr>\r\n                    </table>\r\n                  </fieldset>\r\n             </td>\r\n        \r\n        \r\n         </tr>\r\n         <tr>\r\n              <td> Category<br />\r\n                                                          West Indian                            \r\n                    </td>\r\n                    <td align="left">Age <br />\r\n                                  \r\n                                                        21+                      </td>      \r\n         </tr>\r\n         <tr>\r\n             <td colspan="2">\r\n               Description<br /> \r\n               34343243232321             </td>\r\n         </tr>\r\n         <tr>\r\n            <td colspan="2">\r\n                 <table>\r\n                      <tr>\r\n                          <td>Event Picture</td><td> \r\n                                                        <img src="../events_images/9_4.jpg" style="width:100px;" />\r\n                                                     </td>\r\n                      </tr>\r\n                   </table>\r\n            </td>\r\n         \r\n         </tr> \r\n        \r\n  </td>\r\n </tr>\r\n</table>', 0, '2016-01-20', '0000-00-00', 'active'),
(43, 9, '', '  \r\n   <table class="table v-middle">\r\n        <tr>\r\n            <td colspan="2" align="left">\r\n               <b>Event Name</b><br />\r\n                Test Event             </td>\r\n        \r\n        </tr>\r\n        <tr>\r\n            <td colspan="2" align="left">\r\n               <b>Price</b><br />\r\n                12.00            </td>\r\n        \r\n        </tr>\r\n        <tr>\r\n             <td valign="top">\r\n                  <fieldset>\r\n                    <legend>When?</legend>\r\n                    <table>\r\n                           <tr>\r\n                              <td>\r\n                               Start Date<br />\r\n                                2016-04-23                              </td>\r\n                           </tr>\r\n                           <tr>\r\n                              <td nowrap="nowrap">\r\n                                Start Time<br />\r\n                                \r\n                                1:0 AM                                \r\n                              </td>\r\n                           </tr>\r\n                            <tr>\r\n                              <td>\r\n                               End Date<br />\r\n                                2016-01-30 \r\n                              </td>\r\n                           </tr>\r\n                           <tr>\r\n                              <td nowrap="nowrap">\r\n                                End Time<br />\r\n                                \r\n                               1:0 AM                                \r\n                              </td>\r\n                           </tr>\r\n                            <tr>\r\n                             <td>\r\n                             Timezone<br />\r\n                                                        Atlantic Time (AT)                        </td>\r\n                      </tr>\r\n             \r\n                    </table>\r\n                  </fieldset>\r\n                    \r\n             </td>\r\n             \r\n             <td valign="top">\r\n                   <fieldset>\r\n                    <legend>Where?</legend>\r\n                    <table>\r\n                           <tr>\r\n                              <td>\r\n                              Venue Name<br />\r\n                               34324243\r\n                              </td>\r\n                           </tr>\r\n                           <tr>\r\n                              <td>\r\n                                Venue Post Code<br />\r\n                                1207                              </td>\r\n                           </tr>\r\n                    </table>\r\n                  </fieldset>\r\n             </td>\r\n        \r\n        \r\n         </tr>\r\n         <tr>\r\n              <td> Category<br />\r\n                                                          News Years                            \r\n                    </td>\r\n                    <td align="left">Age <br />\r\n                                  \r\n                                                        3 -12 years old                      </td>      \r\n         </tr>\r\n         <tr>\r\n             <td colspan="2">\r\n               Description<br /> \r\n               dsdsdsdsd             </td>\r\n         </tr>\r\n         <tr>\r\n            <td colspan="2">\r\n                 <table>\r\n                      <tr>\r\n                          <td>Event Picture</td><td> \r\n                                                        <img src="../events_images/10_^950c9e57d765fce1b23de49d40fce01cc3775534031e9d5872^pimgpsh_fullsize_distr.jpg" style="width:100px;" />\r\n                                                     </td>\r\n                      </tr>\r\n                   </table>\r\n            </td>\r\n         \r\n         </tr> \r\n        \r\n  </td>\r\n </tr>\r\n</table>', 0, '2016-01-20', '0000-00-00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=247 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country`) VALUES
(1, 'Afghanistan'),
(2, 'Åland Islands'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua and Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Australia'),
(15, 'Austria'),
(16, 'Azerbaijan'),
(17, 'Bahamas'),
(18, 'Bahrain'),
(19, 'Bangladesh'),
(20, 'Barbados'),
(21, 'Belarus'),
(22, 'Belgium'),
(23, 'Belize'),
(24, 'Benin'),
(25, 'Bermuda'),
(26, 'Bhutan'),
(27, 'Bolivia'),
(28, 'Bosnia and Herzegovina'),
(29, 'Botswana'),
(30, 'Bouvet Island'),
(31, 'Brazil'),
(32, 'British Indian Ocean Territory'),
(33, 'Brunei Darussalam'),
(34, 'Bulgaria'),
(35, 'Burkina Faso'),
(36, 'Burundi'),
(37, 'Cambodia'),
(38, 'Cameroon'),
(39, 'Canada'),
(40, 'Cape Verde'),
(41, 'Cayman Islands'),
(42, 'Central African Republic'),
(43, 'Chad'),
(44, 'Chile'),
(45, 'China'),
(46, 'Christmas Island'),
(47, 'Cocos (Keeling) Islands'),
(48, 'Colombia'),
(49, 'Comoros'),
(50, 'Congo'),
(51, 'Congo, The Democratic Republic of the'),
(52, 'Cook Islands'),
(53, 'Costa Rica'),
(54, 'Côte D''Ivoire'),
(55, 'Croatia'),
(56, 'Cuba'),
(57, 'Cyprus'),
(58, 'Czech Republic'),
(59, 'Denmark'),
(60, 'Djibouti'),
(61, 'Dominica'),
(62, 'Dominican Republic'),
(63, 'Ecuador'),
(64, 'Egypt'),
(65, 'El Salvador'),
(66, 'Equatorial Guinea'),
(67, 'Eritrea'),
(68, 'Estonia'),
(69, 'Ethiopia'),
(70, 'Falkland Islands (Malvinas)'),
(71, 'Faroe Islands'),
(72, 'Fiji'),
(73, 'Finland'),
(74, 'France'),
(75, 'French Guiana'),
(76, 'French Polynesia'),
(77, 'French Southern Territories'),
(78, 'Gabon'),
(79, 'Gambia'),
(80, 'Georgia'),
(81, 'Germany'),
(82, 'Ghana'),
(83, 'Gibraltar'),
(84, 'Greece'),
(85, 'Greenland'),
(86, 'Grenada'),
(87, 'Guadeloupe'),
(88, 'Guam'),
(89, 'Guatemala'),
(90, 'Guernsey'),
(91, 'Guinea'),
(92, 'Guinea-Bissau'),
(93, 'Guyana'),
(94, 'Haiti'),
(95, 'Heard Island and McDonald Islands'),
(96, 'Holy See (Vatican City State)'),
(97, 'Honduras'),
(98, 'Hong Kong'),
(99, 'Hungary'),
(100, 'Iceland'),
(101, 'India'),
(102, 'Indonesia'),
(103, 'Iran, Islamic Republic of'),
(104, 'Iraq'),
(105, 'Ireland'),
(106, 'Isle of Man'),
(107, 'Israel'),
(108, 'Italy'),
(109, 'Jamaica'),
(110, 'Japan'),
(111, 'Jersey'),
(112, 'Jordan'),
(113, 'Kazakhstan'),
(114, 'Kenya'),
(115, 'Kiribati'),
(116, 'Korea, Democratic People''s Republic of'),
(117, 'Korea, Republic of'),
(118, 'Kuwait'),
(119, 'Kyrgyzstan'),
(120, 'Lao People''s Democratic Republic'),
(121, 'Latvia'),
(122, 'Lebanon'),
(123, 'Lesotho'),
(124, 'Liberia'),
(125, 'Libyan Arab Jamahiriya'),
(126, 'Liechtenstein'),
(127, 'Lithuania'),
(128, 'Luxembourg'),
(129, 'Macao'),
(130, 'Macedonia, The Former Yugoslav Republic of'),
(131, 'Madagascar'),
(132, 'Malawi'),
(133, 'Malaysia'),
(134, 'Maldives'),
(135, 'Mali'),
(136, 'Malta'),
(137, 'Marshall Islands'),
(138, 'Martinique'),
(139, 'Mauritania'),
(140, 'Mauritius'),
(141, 'Mayotte'),
(142, 'Mexico'),
(143, 'Micronesia, Federated States of'),
(144, 'Moldova, Republic of'),
(145, 'Monaco'),
(146, 'Mongolia'),
(147, 'Montenegro'),
(148, 'Montserrat'),
(149, 'Morocco'),
(150, 'Mozambique'),
(151, 'Myanmar'),
(152, 'Namibia'),
(153, 'Nauru'),
(154, 'Nepal'),
(155, 'Netherlands'),
(156, 'Netherlands Antilles'),
(157, 'New Caledonia'),
(158, 'New Zealand'),
(159, 'Nicaragua'),
(160, 'Niger'),
(161, 'Nigeria'),
(162, 'Niue'),
(163, 'Norfolk Island'),
(164, 'Northern Mariana Islands'),
(165, 'Norway'),
(166, 'Oman'),
(167, 'Pakistan'),
(168, 'Palau'),
(169, 'Palestinian Territory, Occupied'),
(170, 'Panama'),
(171, 'Papua New Guinea'),
(172, 'Paraguay'),
(173, 'Peru'),
(174, 'Philippines'),
(175, 'Pitcairn'),
(176, 'Poland'),
(177, 'Portugal'),
(178, 'Puerto Rico'),
(179, 'Qatar'),
(180, 'Reunion'),
(181, 'Romania'),
(182, 'Russian Federation'),
(183, 'Rwanda'),
(184, 'Saint Barthélemy'),
(185, 'Saint Helena'),
(186, 'Saint Kitts and Nevis'),
(187, 'Saint Lucia'),
(188, 'Saint Martin'),
(189, 'Saint Pierre and Miquelon'),
(190, 'Saint Vincent and the Grenadines'),
(191, 'Samoa'),
(192, 'San Marino'),
(193, 'Sao Tome and Principe'),
(194, 'Saudi Arabia'),
(195, 'Senegal'),
(196, 'Serbia'),
(197, 'Seychelles'),
(198, 'Sierra Leone'),
(199, 'Singapore'),
(200, 'Slovakia'),
(201, 'Slovenia'),
(202, 'Solomon Islands'),
(203, 'Somalia'),
(204, 'South Africa'),
(205, 'South Georgia and the South Sandwich Islands'),
(206, 'Spain'),
(207, 'Sri Lanka'),
(208, 'Sudan'),
(209, 'Suriname'),
(210, 'Svalbard and Jan Mayen'),
(211, 'Swaziland'),
(212, 'Sweden'),
(213, 'Switzerland'),
(214, 'Syrian Arab Republic'),
(215, 'Taiwan, Province Of China'),
(216, 'Tajikistan'),
(217, 'Tanzania, United Republic of'),
(218, 'Thailand'),
(219, 'Timor-Leste'),
(220, 'Togo'),
(221, 'Tokelau'),
(222, 'Tonga'),
(223, 'Trinidad and Tobago'),
(224, 'Tunisia'),
(225, 'Turkey'),
(226, 'Turkmenistan'),
(227, 'Turks and Caicos Islands'),
(228, 'Tuvalu'),
(229, 'Uganda'),
(230, 'Ukraine'),
(231, 'United Arab Emirates'),
(232, 'United Kingdom'),
(233, 'United States'),
(234, 'United States Minor Outlying Islands'),
(235, 'Uruguay'),
(236, 'Uzbekistan'),
(237, 'Vanuatu'),
(238, 'Venezuela'),
(239, 'Viet Nam'),
(240, 'Virgin Islands, British'),
(241, 'Virgin Islands, U.S.'),
(242, 'Wallis And Futuna'),
(243, 'Western Sahara'),
(244, 'Yemen'),
(245, 'Zambia'),
(246, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `age_id` int(10) NOT NULL,
  `timezone_id` int(10) NOT NULL,
  `ticket_name` varchar(64) NOT NULL,
  `venue_name` varchar(64) NOT NULL,
  `venue_city` varchar(64) NOT NULL,
  `venue_post_code` varchar(64) NOT NULL,
  `start_date` date NOT NULL,
  `start_time_hr` varchar(64) NOT NULL,
  `start_time_min` varchar(64) NOT NULL,
  `start_am_pm` enum('AM','PM') NOT NULL,
  `end_date` date NOT NULL,
  `end_time_hr` varchar(64) NOT NULL,
  `end_time_min` varchar(64) NOT NULL,
  `end_am_pm` enum('AM','PM') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `starting_ticket_no` varchar(64) NOT NULL,
  `in_stock` int(10) NOT NULL,
  `is_security_code` enum('Yes','No') NOT NULL,
  `security_code` varchar(20) NOT NULL,
  `file_ticket` varchar(127) NOT NULL,
  `description` text NOT NULL,
  `file_thumb1` varchar(256) NOT NULL,
  `file_thumb2` varchar(256) NOT NULL,
  `file_thumb3` varchar(256) NOT NULL,
  `background_color` varchar(64) NOT NULL,
  `file_backgroundimage` varchar(127) NOT NULL,
  `is_approved` enum('Yes','No') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `users_id`, `category_id`, `age_id`, `timezone_id`, `ticket_name`, `venue_name`, `venue_city`, `venue_post_code`, `start_date`, `start_time_hr`, `start_time_min`, `start_am_pm`, `end_date`, `end_time_hr`, `end_time_min`, `end_am_pm`, `price`, `starting_ticket_no`, `in_stock`, `is_security_code`, `security_code`, `file_ticket`, `description`, `file_thumb1`, `file_thumb2`, `file_thumb3`, `background_color`, `file_backgroundimage`, `is_approved`, `status`) VALUES
(9, 9, 20, 2, 2, '432424', '34324243', 'Dhaka', '43434', '2016-02-25', '1', '0', 'AM', '2016-05-28', '1', '0', 'AM', '432424.00', '', 23232, '', '', 'events_images/9_4.jpg', '34343243232321', '', '', '', '', '', 'No', 'active'),
(10, 9, 9, 11, 7, 'Test Event ', '34324243', 'Dhaka', '1207', '2016-04-23', '1', '0', 'AM', '2016-01-30', '1', '0', 'AM', '12.00', '', 12, 'Yes', '19262', 'events_images/10_^950c9e57d765fce1b23de49d40fce01cc3775534031e9d5872^pimgpsh_fullsize_distr.jpg', 'dsdsdsdsd', '', '', '', '', '', 'Yes', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `feedkey` varchar(256) NOT NULL,
  `file_feed` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `owner_users_id` int(10) NOT NULL,
  `follow_users_id` int(10) NOT NULL,
  `contents_id` int(10) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `friend_users_id` int(10) NOT NULL,
  `friend_status` enum('accept','pending','rejected') NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `owner_users_id` int(10) NOT NULL,
  `likes_users_id` int(10) NOT NULL,
  `contents_id` int(10) NOT NULL,
  `like_count` int(10) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `owner_users_id`, `likes_users_id`, `contents_id`, `like_count`, `date_created`) VALUES
(1, 9, 9, 28, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `from_users_id` int(10) NOT NULL,
  `to_users_id` int(10) NOT NULL,
  `subject` varchar(127) NOT NULL,
  `message` text NOT NULL,
  `read_status` enum('read','unread') NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_users_id`, `to_users_id`, `subject`, `message`, `read_status`, `date_created`) VALUES
(1, 9, 12, 'Friend request from Anil kumar', 'Anil kumar is interested to make freindship with you', 'read', '2015-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `from_users_id` int(10) NOT NULL,
  `to_users_id` int(10) NOT NULL,
  `message` text NOT NULL,
  `read_status` enum('read','unread') NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `photo_name` varchar(64) NOT NULL,
  `file_photo` varchar(127) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `users_id`, `photo_name`, `file_photo`, `date_created`) VALUES
(2, 9, 'dfgdgfdgd', 'photos_images/2_2012-06-27-product-1.jpg', '2015-12-24'),
(3, 9, '42423424', 'photos_images/3_pixect-20151017224322.jpg', '2015-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `plugin_name` varchar(256) NOT NULL,
  `plugin_description` text NOT NULL,
  `plugin_status` enum('deactive','activate') NOT NULL,
  `uploaded_path` varchar(256) NOT NULL,
  `activated_path` varchar(256) NOT NULL,
  `date_installed` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` (`id`, `plugin_name`, `plugin_description`, `plugin_status`, `uploaded_path`, `activated_path`, `date_installed`) VALUES
(1, 'Photos', ' Amirul Momenin\r\n		    1.0 \r\n		', 'activate', 'D:\\xampp\\htdocs\\linkotopia\\admin\\plugins/install/photos', 'D:\\xampp\\htdocs\\linkotopia\\admin\\plugins/install/photos', '2016-01-09 11:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `plus_login`
--

CREATE TABLE IF NOT EXISTS `plus_login` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `ip` varchar(20) NOT NULL DEFAULT '',
  `tm` bigint(20) NOT NULL,
  `status` enum('online','offline') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `plus_login`
--

INSERT INTO `plus_login` (`id`, `users_id`, `ip`, `tm`, `status`) VALUES
(37, 9, '::1', 1453438757, 'online');

-- --------------------------------------------------------

--
-- Table structure for table `shared`
--

CREATE TABLE IF NOT EXISTS `shared` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `owner_users_id` int(10) NOT NULL,
  `shared_users_id` int(10) NOT NULL,
  `contents_id` int(10) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `skin`
--

CREATE TABLE IF NOT EXISTS `skin` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `background_image` varchar(256) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `skin`
--

INSERT INTO `skin` (`id`, `users_id`, `background_image`, `status`) VALUES
(1, 9, 'events_images/1_light-blue-background-3.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `timezone`
--

CREATE TABLE IF NOT EXISTS `timezone` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `timezone`
--

INSERT INTO `timezone` (`id`, `zone_name`) VALUES
(1, 'Pacific Time (PT)'),
(2, 'Newfoundland Time (NT)'),
(4, 'Mountain Time (MT)'),
(5, 'Eastern Time (ET) '),
(6, 'Central Time (CT)'),
(7, 'Atlantic Time (AT)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `password` varchar(127) NOT NULL,
  `username` varchar(64) NOT NULL,
  `title` varchar(127) NOT NULL,
  `first_name` varchar(127) NOT NULL,
  `last_name` varchar(127) NOT NULL,
  `email` varchar(127) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `company` varchar(127) NOT NULL,
  `address` varchar(127) NOT NULL,
  `city` varchar(127) NOT NULL,
  `state` varchar(127) NOT NULL,
  `zip` varchar(127) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `website` varchar(256) NOT NULL,
  `about_me` text NOT NULL,
  `lives_in` text NOT NULL,
  `hobby` text NOT NULL,
  `occupation` text NOT NULL,
  `works_at` text NOT NULL,
  `country_id` varchar(127) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `verification_code` varchar(256) NOT NULL,
  `verified` enum('yes','no') DEFAULT NULL,
  `file_picture` varchar(127) NOT NULL,
  `file_cover` varchar(127) NOT NULL,
  `type` enum('super','staff','client','visitor') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `username`, `title`, `first_name`, `last_name`, `email`, `phone`, `company`, `address`, `city`, `state`, `zip`, `date_of_birth`, `gender`, `website`, `about_me`, `lives_in`, `hobby`, `occupation`, `works_at`, `country_id`, `created_at`, `updated_at`, `verification_code`, `verified`, `file_picture`, `file_cover`, `type`, `status`) VALUES
(9, 'xx', 'xx', 'Mr.', 'Anil', 'kumar', 'xx', '44234', '545435', 'dsfdsfdsf', 'Dhaka', 'dsfdsfdsfds', 'fdsffdsf', '2015-12-15', 'male', '', '', 'dgfdgdf', 'ffsdfdsfs', 'fdfdfdsf', '', '19', '2011-10-19 00:00:00', '2011-10-19 00:00:00', '', NULL, 'users_images/9_remove.png', '', '', 'active'),
(11, 'Asd123!@#', 'rana100', 'Mr.', 'Amirul', 'Momenin', 'amirrucst@gmail.com', '(312) 213-2312', '321321313', 'Dhaka', 'Dhaka', 'Dhaka', 'A2A2A2', '0000-00-00', 'male', '', '', '', '', '', '', '233', '2015-12-11 13:26:53', '2015-12-11 13:26:53', '76060200158e40a7d2ae12d3e90abe45678b5572', 'no', '', '', 'client', 'inactive'),
(12, 'Asdf!@#123', 'xxxz', 'Mr.', 'WQWw', 'WQWwq', 'aaa@aaa.com', '(313) 231-3123', 'ww3213213213213', '2132323232', '32321321', '321323', 'A2A2A2', '0000-00-00', 'male', '', '', '', '', '', '', '18', '2015-12-11 13:50:13', '2015-12-11 13:50:13', 'c63b624c3a6984961b15e6dac0299126e68ebde8', 'no', '', '', 'client', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) NOT NULL,
  `viwers_users_id` int(10) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `users_id`, `viwers_users_id`, `date_time`) VALUES
(1, 9, 9, '2015-12-23 10:07:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
