-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2016 at 03:08 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cwchildren`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1455971265),
('data entry', '3', 1455971308),
('data view', '2', 1455971296);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1455971361, 1455971361),
('/admin', 2, NULL, NULL, NULL, 1455975503, 1455975503),
('/parent-guardian/create', 2, NULL, NULL, NULL, 1455971717, 1455971717),
('/parent-guardian/delete', 2, NULL, NULL, NULL, 1455971717, 1455971717),
('/parent-guardian/index', 2, NULL, NULL, NULL, 1455971679, 1455971679),
('/parent-guardian/update', 2, NULL, NULL, NULL, 1455971717, 1455971717),
('/parent-guardian/view', 2, NULL, NULL, NULL, 1455971717, 1455971717),
('/session/attendance', 2, NULL, NULL, NULL, 1478088262, 1478088262),
('/session/create', 2, NULL, NULL, NULL, 1478088262, 1478088262),
('/session/index', 2, NULL, NULL, NULL, 1478088167, 1478088167),
('/user/admin/index', 2, NULL, NULL, NULL, 1455975059, 1455975059),
('admin', 1, NULL, NULL, NULL, 1455971145, 1455971145),
('data entry', 1, NULL, NULL, NULL, 1455971197, 1455971197),
('data view', 1, NULL, NULL, NULL, 1455971211, 1455971211);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', '/*'),
('data entry', '/parent-guardian/create'),
('data entry', '/parent-guardian/delete'),
('data entry', '/parent-guardian/update'),
('data entry', 'data view'),
('data view', '/parent-guardian/index'),
('data view', '/parent-guardian/view');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `c_id` int(11) NOT NULL,
  `c_parent_guardian_id` int(11) NOT NULL COMMENT '<md>',
  `c_first_name` varchar(50) NOT NULL,
  `c_surname` varchar(50) NOT NULL,
  `c_address` varchar(60) DEFAULT NULL,
  `c_suburb` varchar(20) DEFAULT NULL,
  `c_post_code` varchar(5) DEFAULT NULL,
  `c_date_of_birth` date DEFAULT NULL,
  `c_gender` varchar(1) NOT NULL,
  `c_toilet_trained` tinyint(1) NOT NULL,
  `c_grade` tinyint(4) NOT NULL,
  `c_medical_conditions` tinyint(1) NOT NULL,
  `c_medical_condition_note` text,
  `c_behavioural_issue` tinyint(1) NOT NULL,
  `c_behavioural_note` text,
  `c_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`c_id`, `c_parent_guardian_id`, `c_first_name`, `c_surname`, `c_address`, `c_suburb`, `c_post_code`, `c_date_of_birth`, `c_gender`, `c_toilet_trained`, `c_grade`, `c_medical_conditions`, `c_medical_condition_note`, `c_behavioural_issue`, `c_behavioural_note`, `c_active`) VALUES
(3, 1, 'Benji', 'Gray', 'Spice Rise', 'HALLAM', '3803', '2016-11-05', 'M', 1, 1, 0, '', 1, 'speech problem ', 1),
(4, 1, 'Hannah', 'Gray', 'Spice Rise', 'HALLAM', '3803', '2016-11-03', 'F', 0, 2, 0, '', 1, '', 1),
(5, 1, 'Harlan', 'Gray', 'Spice Rise', 'HALLAM', '3803', '2016-11-16', 'M', 1, 1, 0, '', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `gd_id` int(11) NOT NULL,
  `gd_name` varchar(20) NOT NULL,
  `gd_sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`gd_id`, `gd_name`, `gd_sort_order`) VALUES
(1, 'Grade 1', 1),
(2, 'Grade 2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(1, 'Enrolment Forms', NULL, '/parent-guardian/index', 5, NULL),
(3, 'Users', NULL, '/user/admin/index', 20, NULL),
(4, 'Admin', NULL, '/admin', 10, NULL),
(5, 'Attendance', NULL, '/session/index', 10, NULL),
(6, 'Create Session', 5, '/session/create', 5, NULL),
(7, 'Sessions', 5, '/session/index', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1455962825),
('m140209_132017_init', 1455962829),
('m140403_174025_create_account_table', 1455962831),
('m140504_113157_update_tables', 1455962836),
('m140504_130429_create_token_table', 1455962837),
('m140506_102106_rbac_init', 1455970713),
('m140602_111327_create_menu_table', 1455970509),
('m140830_171933_fix_ip_field', 1455962838),
('m140830_172703_change_account_table_name', 1455962838),
('m141222_110026_update_ip_field', 1455962839),
('m141222_135246_alter_username_length', 1455962840),
('m150614_103145_update_social_account_table', 1455962842),
('m150623_212711_fix_username_notnull', 1455962843);

-- --------------------------------------------------------

--
-- Table structure for table `parent_guardian`
--

CREATE TABLE `parent_guardian` (
  `pg_id` int(11) NOT NULL,
  `pg_father_first_name` varchar(100) DEFAULT NULL,
  `pg_father_surname` varchar(100) DEFAULT NULL,
  `pg_father_contact_number` varchar(15) DEFAULT NULL,
  `pg_father_email` varchar(30) DEFAULT NULL,
  `pg_mother_first_name` varchar(100) DEFAULT NULL,
  `pg_mother_surname` varchar(100) DEFAULT NULL,
  `pg_mother_contact_number` varchar(15) DEFAULT NULL,
  `pg_mother_email` varchar(30) DEFAULT NULL,
  `pg_court_orders` tinyint(1) NOT NULL,
  `pg_court_order_note` text,
  `pg_authorize_medical` tinyint(1) NOT NULL,
  `pg_photo_permission` tinyint(1) NOT NULL,
  `pg_date` date NOT NULL,
  `pg_name_parent_guardian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent_guardian`
--

INSERT INTO `parent_guardian` (`pg_id`, `pg_father_first_name`, `pg_father_surname`, `pg_father_contact_number`, `pg_father_email`, `pg_mother_first_name`, `pg_mother_surname`, `pg_mother_contact_number`, `pg_mother_email`, `pg_court_orders`, `pg_court_order_note`, `pg_authorize_medical`, `pg_photo_permission`, `pg_date`, `pg_name_parent_guardian`) VALUES
(1, 'Hans', 'Gray', '', '', 'Jo', 'Gray', '', 'harlan.gray@gmail.com', 1, 'some court', 1, 1, '2016-11-05', 'Hans Gray');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `ssn_id` int(11) NOT NULL,
  `ssn_name` varchar(50) NOT NULL,
  `ssn_date` date NOT NULL,
  `ssn_marked_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`ssn_id`, `ssn_name`, `ssn_date`, `ssn_marked_by`) VALUES
(6, 'Sunday School (2016-11-07)', '2016-11-07', 1),
(7, 'Sunday School (2016-11-07)', '2016-11-08', 1),
(8, 'Sunday School (2016-11-11)', '2016-11-11', 3);

-- --------------------------------------------------------

--
-- Table structure for table `session_attendance`
--

CREATE TABLE `session_attendance` (
  `sat_id` int(11) NOT NULL,
  `sat_session_id` int(11) NOT NULL,
  `sat_student_id` int(11) NOT NULL,
  `sat_present` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_attendance`
--

INSERT INTO `session_attendance` (`sat_id`, `sat_session_id`, `sat_student_id`, `sat_present`) VALUES
(7, 6, 3, 0),
(8, 6, 4, 1),
(9, 7, 3, 1),
(10, 7, 4, 1),
(11, 8, 3, 1),
(12, 8, 4, 1),
(13, 8, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1, '2AEMXspuXxbfB-hz8RdUlwZop4zTLoms', 1455963011, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`) VALUES
(1, 'admin', 'harlan.gray@gmail.com', '$2y$10$bwzQPtMRV6YfYy8khLSEiOdoFWJvWZeU4k.e7hPdtA.001uR7d57i', 'A9h4jb8imS_yiuoxu5vGaDD120yWGC2P', 1455969652, NULL, NULL, '::1', 1455963011, 1455963011, 0),
(2, 'joanna', 'joanna.gray@gmail.com', '$2y$12$qFhIvyPc4s2SyjjVDQJR/envT9zOdA8S0mVWbL0aWSSPgDy7z3WYO', 'o3o2Og9En41duJK-h4BAkTDP0rOvve4m', 1455969804, NULL, NULL, '::1', 1455969804, 1455969804, 0),
(3, 'andrew', 'andrew@cwc.org.au', '$2y$12$Q49srPIZoI.8mjBZX34EzeAb86RE76WS.sfrk1d1ar9t2LDiaUA9K', 'gykJjq-fQo4TljQFwFpYiDz62rxRJMib', 1455969914, NULL, NULL, '::1', 1455969914, 1455969914, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `c_care_taker_id` (`c_parent_guardian_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`gd_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `parent_guardian`
--
ALTER TABLE `parent_guardian`
  ADD PRIMARY KEY (`pg_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`ssn_id`);

--
-- Indexes for table `session_attendance`
--
ALTER TABLE `session_attendance`
  ADD PRIMARY KEY (`sat_id`);

--
-- Indexes for table `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_email` (`email`),
  ADD UNIQUE KEY `user_unique_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `gd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `parent_guardian`
--
ALTER TABLE `parent_guardian`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `ssn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `session_attendance`
--
ALTER TABLE `session_attendance`
  MODIFY `sat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `child`
--
ALTER TABLE `child`
  ADD CONSTRAINT `parent_guardian` FOREIGN KEY (`c_parent_guardian_id`) REFERENCES `parent_guardian` (`pg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
