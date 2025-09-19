-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2015 at 04:21 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alumni_aus_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`password`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `joined`) VALUES
(1, 'admin', '788073cefde4b240873e1f52f5371d7d', '2015-03-08 11:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE IF NOT EXISTS `alumni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) NOT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `address` text,
  `organization` text,
  `campus` int(11) NOT NULL,
  `school` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `session_from` varchar(50) NOT NULL,
  `session_to` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `campus` (`campus`),
  KEY `campus_2` (`campus`),
  KEY `school` (`school`),
  KEY `campus_3` (`campus`),
  KEY `school_2` (`school`),
  KEY `school_3` (`school`),
  KEY `department` (`department`),
  KEY `course` (`course`),
  KEY `course_2` (`course`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE IF NOT EXISTS `campuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `established` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`id`, `name`, `established`) VALUES
(1, 'Silchar', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE IF NOT EXISTS `carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `desc` text,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `desc`, `url`) VALUES
(2, 'Front', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum lacus sed velit luctus tempus. Ut bibendum gravida rutrum. Phasellus et ipsum id ante interdum laoreet. Vivamus pharetra tortor sed libero interdum at volutpat arcu cursus. ', 'a.jpg'),
(3, 'Middle', 'Donec sed lectus tellus. Cras felis leo, imperdiet a interdum in, vestibulum eu quam. Donec elit est, interdum eget mattis quis, semper ac est. Nam dignissim ultrices risus, a ornare justo pretium vitae. Quisque vitae pellentesque mauris. Cras consectetur laoreet adipiscing.', 'b.jpg'),
(4, 'Back', 'In hac habitasse platea dictumst. Nulla a velit dolor. Vestibulum in purus libero. Donec et orci libero. Proin eget lacinia nisi. Proin eget pretium nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse purus diam, adipiscing quis ultrices in, fringilla non neque.', 'c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `duration` int(11) DEFAULT NULL COMMENT 'in no of months',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `duration`) VALUES
(9, 'MA', 0),
(10, 'MSc', 0),
(11, 'BTech', 0),
(12, 'MTech', 0),
(13, 'BA', 0),
(14, 'BSc', 0),
(15, 'BCom', 0),
(16, 'MCom', 0),
(17, 'MPhill', 0),
(18, 'Phd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `established` year(4) DEFAULT NULL,
  `school` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `school` (`school`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `established`, `school`) VALUES
(5, 'History', 0000, 9),
(7, 'Political Science', 0000, 9),
(8, 'Information Technology', 2006, 1),
(9, 'Physics', 0000, 15),
(10, 'Chemistry', 0000, 15),
(11, 'Mathematics', 0000, 15);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `body` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `name`, `email`, `subject`, `body`, `created`) VALUES
(1, 'Tushar', 'megoto4@gmail.com', 'Kathmandu-Varanasi-Kathmandu bus service flagged off\n', 'Nepal and India on 5 March 2015 launched a direct bus service linking cultural cities Kathmandu and Varanasi. Kathmandu-Varanasi-Kathmandu bus service was launched under the ambit of Motor Vehicle Agreement between India and Nepal signed during 18th SAARC Summit.', '2015-03-06 15:00:38'),
(2, 'AUS', 'tushargoto@gmail.com', 'Key facts  Read more at: http://currentaffairs.gktoday.in/page/2', 'This is the second direct bus service between Nepal and India after the one linking Kathmandu and New Delhi. Earlier in November 2014 during the 18th SAARC Summit Prime Minister Narendra Modi and Nepal’s Prime Minister Sushil Koirala had jointly launched the direct bus service between Kathmandu and the New Delhi.\r\n\r\nRead more at: http://currentaffairs.gktoday.in/page/2', '2015-03-06 15:21:40'),
(3, 'AUS Alumni ORG', 'sarmagoto@yahoo.com', 'Prime Minister Narendra Modi named among 30 most influential people on internet: Time Magazine', 'Time Magazine has named Indian Prime Minister Narendra Modi among the list of 30 most influential people on the internet. As per Time magazine PM Narendra Modi has around 38 million followers on social networking sites Twitter and Facebook. He is ardent user of social media and uses it to communicate and reach to India’s 200 million-plus online population directly. However PM Narendra Modi is behind US President Barack who is also in the list and most-liked world leader on Facebook and the most-followed on Twitter. The list also includes British author J K Rowling of the Harry Potter series, singers Beyonce and Taylor Swift. Time Magazine‘s 30 most influential people list on internet was prepared by analyzing the social-media followings, site traffic and overall ability to drive news of famous people.\r\n', '2015-03-06 17:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `content` text NOT NULL,
  `created` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `site` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `site` (`site`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `created`, `status`, `site`) VALUES
(4, 'Airtel and China Mobile inks MoU for evolving technologies and equipment procurement  ', 'Indian telecom giant Bharti Airtel and worldâ€™s largest telecom operator China Mobile have signed a partnership memorandum of understanding (MoU) to work jointly on evolving high technologies like 4G, 5G and procuring telecom devices and equipment. The MoU was signed by China Mobile Chairman Xi Guohua and Bharti Airtel founder and Chairman Sunil Bharti Mittal. Key highlights of MoU Both telecom giants will work together TD-LTE (Time division-Long-term evolution) technology. They will cooperate on products development and standards, promoting growth in a robust ecosystem to accelerate the commercialization of TD-LTE and evolving technologies like 4.5G/5G. Both companies will also work towards shaping up a joint strategy for procurement of devices that include Wifi devices, smart phones, data cards, LTE Consumer Premise Equipments (CPEâ€™s) and Universal SIM (USIM). :)\r\n\r\nRead more at: http://currentaffairs.gktoday.in/page/2', '2015-03-05', 1, 1),
(5, 'RBI cuts repo rate by 25 basis points to 7.5 percent', 'The Reserve Bank of India (RBI) on 4 March 2015 has cut down repo rate by 25 basis points to 7.5 percent from 7.75 percent, with immediate effect. However, RBI has kept the cash reserve ratio (CRR) unchanged at 4 percent. It is the second change in rates by 25 basis points since January 2015. With this change, RBI is signaling that it was convinced by the fiscal consolidation measures announced in the Budget.\r\n\r\nRead more at: http://currentaffairs.gktoday.in/page/3', '2015-03-05', 1, 1),
(6, 'Parliament passes Citizenship (Amendment) Bill, ', 'Parliament has passed the Citizenship (Amendment) Bill, 2015. It was passed by Rajya Sabha on 4 March and earlier by Lok Sabha on 2 March 2015. This bill will replace an ordinance promulgated in this regard and amend the Citizenship Act, 1955.\r\n\r\nRead more at: http://currentaffairs.gktoday.in/', '2015-03-05', 1, 1),
(8, 'Welcome to CodeIgniter', 'CodeIgniter is an Application Development Framework - a toolkit - for people who build web sites using PHP. Its goal is to enable you to develop projects much faster than you could if you were writing code from scratch, by providing a rich set of libraries for commonly needed tasks, as well as a simple interface and logical structure to access these libraries. CodeIgniter lets you creatively focus on your project by minimizing the amount of code needed for a given task.', '2015-03-05', 1, 1),
(9, 'Union MoS for Consumer Affairs', 'Union Minister Minister of State (MoS) for Consumer Affairs, Food and Public Distribution Raosaheb Dadarao Danve on 5 March 2015 resigned from the office. He submitted his resignation to Prime Minister Narendra Modi who accepted it and forwarded it to President Pranab Mukherjee. Raosaheb Danve resigned from the Union Council of Ministers  following the Bharatiya Janta Party (BJPs) one-man, one-post principle after he was appointed President of Maharashtra in January 2015. He took over as Maharashtra BJP president after Devendra Fadnavis became the Chief Minister state who had led the party to power in  October 2014 Assembly elections.\r\n', '2015-03-06', 1, 1),
(10, 'Kathmandu-Varanasi-Kathmandu bus service flagged off', 'Nepal and India on 5 March 2015 launched a direct bus service linking cultural cities Kathmandu and Varanasi. Kathmandu-Varanasi-Kathmandu bus service was launched under the ambit of Motor Vehicle Agreement between India and Nepal signed during 18th SAARC Summit. Key facts Kathmandu-Varanasi-Kathmandu bus service seeks to promote religious tourism and people-to-people contact between both countries by connecting the two religious cities. This bus service will connect Kathmandu’s Pashupatinath Temple with Varanasi’s Kashi Vishwanath Temple as both shrines are considered important pilgrimage sites by Shiva worshippers all around the world Route of bus service- It will take the Bhairahawa-Gorakhpur route and cover about 600 km distance in 12 hours.\r\n\r\nRead more at: http://currentaffairs.gktoday.in/', '2015-03-06', 1, 1),
(11, 'Sri Lankan Government suspends China port city project', 'Sri Lanka’s newly elected government on 5 March 2015 has temporarily suspended constriction work of China’s ambitious port city project in Colombo with immediate effect. The decision was taken in Cabinet meeting chaired by Sri Lanka’s Prime Minister Ranil Wickremasinghe based upon the Interim Report submitted by a cabinet sub-committee. The committee was appointed by the Sri Lankan Government to review the project. The Interim Report had alleged that this mega real estate deal with China was signed Without cabinet approval. Without following procedures. Implemented without relevant approvals from the concerned institutions.\r\n\r\nRead more at: http://currentaffairs.gktoday.in/', '2015-03-06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(400) NOT NULL,
  `content` text,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `menu_entry` tinyint(1) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `parent`, `name`, `title`, `content`, `visible`, `menu_entry`, `created`, `publish`) VALUES
(1, NULL, 'about_us', 'About us', 'CodeIgniter is an Application Development Framework - a toolkit - for people who build web sites using PHP. Its goal is to enable you to develop projects much faster than you could if you were writing code from scratch, by providing a rich set of libraries for commonly needed tasks, as well as a simple interface and logical structure to access these libraries. CodeIgniter lets you creatively focus on your project by minimizing the amount of code needed for a given task.', 1, 1, '2015-03-07 03:21:17', 1),
(2, NULL, 'mission', 'Mission', 'CodeIgniter is right for you if:\r\n\r\nYou want a framework with a small footprint.\r\nYou need exceptional performance.\r\nYou need broad compatibility with standard hosting accounts that run a variety of PHP versions and configurations.\r\nYou want a framework that requires nearly zero configuration.\r\nYou want a framework that does not require you to use the command line.\r\nYou want a framework that does not require you to adhere to restrictive coding rules.\r\nYou do not want to be forced to learn a templating language (although a template parser is optionally available if you desire one).\r\nYou eschew complexity, favoring simple solutions.\r\nYou need clear, thorough documentation.\r\n0000000000000000', 1, 1, '2015-03-07 03:32:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

CREATE TABLE IF NOT EXISTS `registered` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) NOT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `address` text,
  `organization` text,
  `campus` int(11) NOT NULL,
  `school` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `session_from` varchar(50) NOT NULL,
  `session_to` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campus` (`campus`),
  KEY `campus_2` (`campus`),
  KEY `school` (`school`),
  KEY `campus_3` (`campus`),
  KEY `school_2` (`school`),
  KEY `school_3` (`school`),
  KEY `department` (`department`),
  KEY `course` (`course`),
  KEY `course_2` (`course`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `campus` int(6) NOT NULL DEFAULT '1',
  `established` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campus` (`campus`),
  KEY `campus_2` (`campus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `campus`, `established`) VALUES
(1, 'Technology', 1, 2006),
(9, 'Social Science', 1, 0000),
(10, 'Economics and Commerce', 1, 0000),
(11, 'English and Foreign Language Studies', 1, 0000),
(12, 'Indian Language and Cultural Studies', 1, 0000),
(13, 'Creative Arts and Communication Studies', 1, 0000),
(14, 'Education', 1, 0000),
(15, 'Physical Science', 1, 0000),
(16, 'Life Science', 1, 0000),
(17, 'Management', 1, 0000),
(18, 'Environmental Sciences', 1, 0000),
(19, 'Medical & Paramedical Sciences', 1, 0000),
(20, 'Earth Sciences', 1, 0000),
(21, 'Library Sciences', 1, 0000),
(22, 'Legal Studies', 1, 0000),
(23, 'Philosophy', 1, 0000);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `slogun` varchar(300) DEFAULT NULL,
  `logo` varchar(300) NOT NULL,
  `logo_size` int(11) NOT NULL DEFAULT '100',
  `contact` text,
  `copyright` varchar(300) NOT NULL,
  `owner` varchar(100) NOT NULL DEFAULT 'NIL',
  `serial_key` varchar(50) NOT NULL DEFAULT 'NIL',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `name`, `slogun`, `logo`, `logo_size`, `contact`, `copyright`, `owner`, `serial_key`, `status`) VALUES
(1, 'Assam University Alumni Association', '(A Central University Established by an Act of Parliament)', 'Assam_University_logo.jpg', 100, 'Postal address :-\r\nAssam University\r\nSilchar - 788 011, Assam, India\r\nFax:-91-03842-270802\r\nPhone Nos:-\r\nRegistrar : 91-03842-270806\r\nE-mail :-\r\nvc@aus.ac.in\r\nregistrar@aus.ac.in<!-- ***** Following code is the map viewer iframe. Do not edit unless you know what are you actually doing. --><div class="row"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3625.075070066753!2d92.751228!3d24.689945999999978!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x374e3827427b6f43%3A0x4556a6b3074df1de!2sAssam+University+Silchar!5e0!3m2!1sen!2sin!4v1425636694886" class="span12" height="450" frameborder="0" style="border:0"></iframe></div>', 'Copyright © 2015, Assam University Silchar. For website related information contact dir_cc@aus.ac.in', 'Assam University', 'cfe6b614bf621d517e875d11e117c509', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni`
--
ALTER TABLE `alumni`
  ADD CONSTRAINT `alumni_ibfk_1` FOREIGN KEY (`campus`) REFERENCES `campuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `alumni_ibfk_2` FOREIGN KEY (`school`) REFERENCES `schools` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `alumni_ibfk_3` FOREIGN KEY (`department`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `alumni_ibfk_4` FOREIGN KEY (`course`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_2` FOREIGN KEY (`school`) REFERENCES `schools` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_ibfk_1` FOREIGN KEY (`campus`) REFERENCES `campuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
