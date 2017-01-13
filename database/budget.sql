-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2017 at 06:43 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budget`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget_instance`
--

CREATE TABLE `budget_instance` (
  `budget_instance_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget_instance`
--

INSERT INTO `budget_instance` (`budget_instance_id`, `name`, `description`) VALUES
(108, 'test', ''),
(109, 'test ', ''),
(110, 'asfasf', ''),
(113, 'Test', ''),
(114, 'sddr', ''),
(115, 'zfdgdfg', ''),
(116, 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `budget_instance_catagory`
--

CREATE TABLE `budget_instance_catagory` (
  `budget_Instance_catagory_id` int(11) UNSIGNED NOT NULL,
  `catagory_id` int(11) UNSIGNED NOT NULL,
  `budget_Instance_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget_instance_catagory`
--

INSERT INTO `budget_instance_catagory` (`budget_Instance_catagory_id`, `catagory_id`, `budget_Instance_id`) VALUES
(52, 67, 108),
(53, 68, 108),
(54, 69, 108),
(55, 70, 108),
(59, 74, 108),
(61, 68, 108),
(63, 77, 108),
(64, 78, 108),
(69, 83, 108),
(73, 86, 108),
(74, 87, 108),
(75, 88, 108),
(76, 89, 109),
(77, 90, 109),
(78, 91, 109),
(79, 92, 109),
(80, 93, 109),
(83, 96, 109),
(86, 99, 109),
(87, 100, 109),
(88, 101, 109),
(94, 107, 113),
(95, 108, 113),
(96, 109, 113),
(97, 110, 113),
(98, 111, 116);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`) VALUES
(67, 'test 1', ''),
(68, 'test 2', ''),
(69, 'test 3', ''),
(70, 'test 4', ''),
(74, 'test two', ''),
(77, 'test 90', ''),
(78, 'the', ''),
(83, 'rdu', ''),
(86, 'test 200', ''),
(87, 'okay', ''),
(88, 'test ', ''),
(89, 'this', ''),
(90, 'xdfg', ''),
(91, 'SDFSDFSDF', ''),
(92, 'SDFSDFSSDF', ''),
(93, 'test 4', ''),
(96, 'tetet', ''),
(99, 'sf', ''),
(100, 'zcfg', ''),
(101, 'tr', ''),
(102, 'sam', ''),
(103, 'ra', ''),
(105, 'fuel', ''),
(107, 'Test', ''),
(108, 'grey', ''),
(109, 'greys', ''),
(110, 'greyst', ''),
(111, 'fridge', '');

-- --------------------------------------------------------

--
-- Table structure for table `category_amounts`
--

CREATE TABLE `category_amounts` (
  `catergory_amount_id` int(11) UNSIGNED NOT NULL,
  `actual_amount` double(14,2) NOT NULL,
  `projected_amount` double(14,2) NOT NULL,
  `catergory_id` int(11) UNSIGNED NOT NULL,
  `time_line_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_amounts`
--

INSERT INTO `category_amounts` (`catergory_amount_id`, `actual_amount`, `projected_amount`, `catergory_id`, `time_line_id`) VALUES
(87, 500.00, 500.00, 67, 138),
(88, 500.00, 500.00, 68, 138),
(89, 500.00, 500.00, 69, 138),
(90, 500.00, 500.00, 70, 138),
(91, 0.00, 500.00, 67, 139),
(98, 0.00, 500.00, 74, 139),
(102, 0.00, 500.00, 74, 140),
(104, 40.00, 40.00, 68, 140),
(106, 100.00, 4000.00, 77, 140),
(107, 500.00, 500.00, 78, 140),
(112, 456.00, 456.00, 83, 140),
(116, 100.00, 100.00, 86, 140),
(117, 55.00, 66.00, 87, 140),
(118, 600.00, 500.00, 88, 140),
(119, 600.00, 500.00, 89, 141),
(120, 123123.00, 0.00, 90, 141),
(121, 0.00, 0.00, 91, 141),
(122, 20.00, 50.00, 92, 141),
(123, 500.00, 500.00, 93, 141),
(126, 500.00, 500.00, 96, 141),
(129, 5.00, 5.00, 99, 141),
(130, 7.00, 7.00, 100, 141),
(132, 5.98, 5.90, 101, 141),
(138, 45.00, 55.00, 107, 145),
(139, 56.01, 90.00, 108, 145),
(140, 56.02, 90.00, 109, 145),
(141, 56.03, 90.00, 110, 145),
(142, 5000.00, 10000.00, 111, 148);

-- --------------------------------------------------------

--
-- Table structure for table `category_state`
--

CREATE TABLE `category_state` (
  `state` enum('active','deactivated','removed','') NOT NULL DEFAULT 'active',
  `time_line_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_state`
--

INSERT INTO `category_state` (`state`, `time_line_id`, `category_id`) VALUES
('deactivated', 138, 67),
('deactivated', 138, 68),
('deactivated', 138, 69),
('deactivated', 138, 70),
('deactivated', 139, 67),
('deactivated', 139, 68),
('deactivated', 139, 69),
('deactivated', 139, 70),
('deactivated', 139, 74),
('removed', 140, 67),
('active', 140, 74),
('active', 140, 68),
('active', 140, 77),
('active', 140, 78),
('active', 140, 83),
('active', 140, 86),
('active', 140, 87),
('active', 140, 88),
('active', 141, 89),
('active', 141, 90),
('active', 141, 91),
('active', 141, 92),
('active', 141, 93),
('active', 141, 96),
('active', 141, 99),
('active', 141, 100),
('active', 141, 101),
('active', 145, 107),
('active', 145, 108),
('active', 145, 109),
('active', 145, 110),
('active', 148, 111);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `curency_id` int(11) UNSIGNED NOT NULL,
  `country` varchar(12) NOT NULL,
  `code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`curency_id`, `country`, `code`) VALUES
(1, 'South Africa', 'R'),
(2, 'USA', '&#36');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friend_id` int(11) UNSIGNED NOT NULL,
  `status` enum('friend','unfriend') NOT NULL DEFAULT 'friend',
  `own_user_id` int(11) UNSIGNED NOT NULL,
  `friend_user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend_id`, `status`, `own_user_id`, `friend_user_id`) VALUES
(1, 'friend', 49, 33),
(2, 'friend', 33, 49),
(3, 'friend', 48, 33),
(4, 'friend', 33, 48);

-- --------------------------------------------------------

--
-- Stand-in structure for view `friends_with_budgets`
-- (See below for the actual view)
--
CREATE TABLE `friends_with_budgets` (
`own_user_id` int(11) unsigned
,`friend_user_id` int(11) unsigned
,`user_id` int(11) unsigned
,`firstname` varchar(20)
,`last_name` varchar(20)
,`budget_Instance_ID` int(11) unsigned
,`budget_instance_user_id` int(11) unsigned
,`name` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

CREATE TABLE `friend_request` (
  `friend_request_id` int(11) UNSIGNED NOT NULL,
  `requester` int(11) UNSIGNED NOT NULL,
  `requestee` int(11) UNSIGNED NOT NULL,
  `state` enum('waiting','accepted','ignored','denied') NOT NULL DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`friend_request_id`, `requester`, `requestee`, `state`) VALUES
(1060, 33, 50, 'waiting'),
(1061, 33, 49, 'accepted'),
(1116, 33, 48, 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE `goal` (
  `goal_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `amount_per_frequncy` enum('weekly','biweekly','monthly') NOT NULL DEFAULT 'monthly',
  `Goal_Actual_amout` double NOT NULL,
  `Goal_Projected_amout` double NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `budget_Instance_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int(11) UNSIGNED NOT NULL,
  `income` double(14,2) NOT NULL,
  `budget_Instance_ID` int(11) UNSIGNED NOT NULL,
  `time_line_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `income`, `budget_Instance_ID`, `time_line_id`, `user_id`, `description`) VALUES
(112, 500.00, 108, 138, 27, ''),
(113, 500.00, 108, 139, 27, ''),
(114, 500.00, 108, 140, 27, ''),
(115, 500.00, 109, 141, 27, ''),
(116, 20000.59, 110, 142, 27, ''),
(120, 500.00, 114, 146, 27, 'dfg'),
(121, 20000.00, 116, 148, 61, 'Salary'),
(122, 500.00, 116, 148, 61, 'more'),
(123, 250.00, 116, 148, 61, 'tax return'),
(125, 5465.00, 113, 145, 60, 'sdfsd');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `state` enum('seen','unseen') NOT NULL DEFAULT 'unseen'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `message`, `user_id`, `state`) VALUES
(1, 'you request has be accepted from your friend catherine gentles', 33, 'seen'),
(2, 'you request has be accepted from your friend test test', 33, 'unseen');

-- --------------------------------------------------------

--
-- Table structure for table `preference`
--

CREATE TABLE `preference` (
  `preference_id` int(11) UNSIGNED NOT NULL,
  `currency_id` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `preference`
--

INSERT INTO `preference` (`preference_id`, `currency_id`, `user_id`) VALUES
(1, 2, 55),
(2, 1, 60),
(3, 1, 61);

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

CREATE TABLE `savings` (
  `savings_id` int(11) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `time_line_id` int(11) UNSIGNED NOT NULL,
  `budget_Instance_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `time_line`
--

CREATE TABLE `time_line` (
  `time_line_id` int(11) UNSIGNED NOT NULL,
  `duration_start` date NOT NULL,
  `duration_end` date NOT NULL,
  `frequency` enum('weekly','biweekly','monthly') NOT NULL DEFAULT 'monthly',
  `state` enum('active','deactivated') NOT NULL DEFAULT 'active',
  `reset_day` int(2) NOT NULL DEFAULT '0',
  `budget_Instance_ID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_line`
--

INSERT INTO `time_line` (`time_line_id`, `duration_start`, `duration_end`, `frequency`, `state`, `reset_day`, `budget_Instance_ID`) VALUES
(138, '2016-01-01', '2016-02-01', 'monthly', 'deactivated', 1, 108),
(139, '2016-12-01', '2017-01-01', 'monthly', 'deactivated', 1, 108),
(140, '2017-01-01', '2017-02-01', 'monthly', 'active', 1, 108),
(141, '2017-01-11', '2017-02-11', 'monthly', 'active', 11, 109),
(142, '2017-01-12', '2017-02-12', 'monthly', 'active', 12, 110),
(145, '2017-01-13', '2017-02-13', 'monthly', 'active', 13, 113),
(146, '2017-01-13', '2017-02-13', 'monthly', 'active', 13, 114),
(147, '2017-01-01', '2017-02-01', 'monthly', 'active', 1, 115),
(148, '2017-01-13', '2017-02-13', 'monthly', 'active', 13, 116);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(40) NOT NULL,
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `role` enum('strd','admin') NOT NULL DEFAULT 'strd'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `last_name`, `email`, `time_stamp`, `password`, `gender`, `role`) VALUES
(27, 'admin', 'admin', 'admin@admin.com', '2016-11-25 12:49:16', 'JERekfOpfyKW/mGeJ1v5ow==', 'male', 'strd'),
(33, 'esa', 'esa', 'esa@esa.com', '2016-11-27 04:20:55', 'ZixW50M9tw4kBTwNg1AfEA==', 'male', 'strd'),
(48, 'test', 'test', 'test@test.com', '2016-11-28 10:29:56', 'MyW7kXjExZ8LWHO1r3QaRw==', 'male', 'admin'),
(49, 'catherine', 'gentles', 'cath@gmail.com', '2016-12-02 19:28:59', 'bU2cDTb08dWmbHW4W4bV2Q==', 'female', 'strd'),
(50, 'rus', 'rus', 'rus@rus.com', '2016-12-07 07:24:45', 'VLwgQpX81XLfhv06htKy8w==', 'male', 'strd'),
(52, 'adolf', 'adolf', 'adolf@adolf.com', '2016-12-07 12:30:45', 'UJFpC7HYzBSBsO+VBNT4Fw==', 'male', 'strd'),
(53, 'min', 'min', 'min@min.com', '2017-01-06 07:31:19', 'WkZxTkl2yhF/dKcN40mzkg==', 'male', 'strd'),
(55, 'dean', 'dean', 'dean@dean.com', '2017-01-12 11:16:36', 'PF+5+uHduQ+rKt5uG/iNIQ==', 'male', 'strd'),
(58, 'Duke', 'Duke', 'duke@duke.com', '2017-01-12 18:03:52', 'J5K2qUC8zf9t2J9rXGvmWA==', 'male', 'strd'),
(59, 'dash', 'dash', 'dash@dash.com', '2017-01-12 18:05:07', 'AeGd7zvyaVs3MtLz9NAGAA==', 'male', 'strd'),
(60, 'goat', 'goat', 'goat@goat.com', '2017-01-12 18:08:07', 'aFxZoJ0Qs/VLrB2oXb4Aaw==', 'male', 'strd'),
(61, 'guss', 'guss', 'guss@guss.com', '2017-01-13 15:30:01', 's+wDM/z2pgRqWdt9n+jKPA==', 'male', 'strd');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_budgets`
-- (See below for the actual view)
--
CREATE TABLE `user_budgets` (
`user_id` int(11) unsigned
,`name` varchar(20)
,`budget_instance_id` int(11) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `user_budget_instance`
--

CREATE TABLE `user_budget_instance` (
  `user_budget_Instance_Id` int(11) UNSIGNED NOT NULL,
  `budget_Instance_ID` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_budget_instance`
--

INSERT INTO `user_budget_instance` (`user_budget_Instance_Id`, `budget_Instance_ID`, `user_id`) VALUES
(127, 108, 48),
(128, 109, 49),
(129, 110, 49),
(132, 113, 60),
(133, 114, 48),
(134, 115, 60),
(135, 116, 61);

-- --------------------------------------------------------

--
-- Structure for view `friends_with_budgets`
--
DROP TABLE IF EXISTS `friends_with_budgets`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `friends_with_budgets`  AS  select `f`.`own_user_id` AS `own_user_id`,`f`.`friend_user_id` AS `friend_user_id`,`u`.`user_id` AS `user_id`,`u`.`firstname` AS `firstname`,`u`.`last_name` AS `last_name`,`ubi`.`budget_Instance_ID` AS `budget_Instance_ID`,`ubi`.`user_id` AS `budget_instance_user_id`,`bi`.`name` AS `name` from (((`friends` `f` join `user` `u` on(((`u`.`user_id` = `f`.`friend_user_id`) or (`u`.`user_id` = `f`.`own_user_id`)))) left join `user_budget_instance` `ubi` on((`ubi`.`user_id` = `u`.`user_id`))) left join `budget_instance` `bi` on((`ubi`.`budget_Instance_ID` = `bi`.`budget_instance_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `user_budgets`
--
DROP TABLE IF EXISTS `user_budgets`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_budgets`  AS  select `u`.`user_id` AS `user_id`,`bi`.`name` AS `name`,`bi`.`budget_instance_id` AS `budget_instance_id` from ((`budget_instance` `bi` join `user_budget_instance` `ubi` on((`bi`.`budget_instance_id` = `ubi`.`budget_Instance_ID`))) join `user` `u` on((`u`.`user_id` = `ubi`.`user_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget_instance`
--
ALTER TABLE `budget_instance`
  ADD PRIMARY KEY (`budget_instance_id`);

--
-- Indexes for table `budget_instance_catagory`
--
ALTER TABLE `budget_instance_catagory`
  ADD PRIMARY KEY (`budget_Instance_catagory_id`),
  ADD KEY `catagory_id` (`catagory_id`),
  ADD KEY `budget_Instance_id` (`budget_Instance_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`,`name`),
  ADD UNIQUE KEY `category_id_2` (`category_id`),
  ADD UNIQUE KEY `category_id_3` (`category_id`);

--
-- Indexes for table `category_amounts`
--
ALTER TABLE `category_amounts`
  ADD PRIMARY KEY (`catergory_amount_id`),
  ADD KEY `catergory_id` (`catergory_id`),
  ADD KEY `time_line_id` (`time_line_id`);

--
-- Indexes for table `category_state`
--
ALTER TABLE `category_state`
  ADD KEY `time_line_id` (`time_line_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`curency_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friend_id`),
  ADD KEY `friend_user_id` (`friend_user_id`),
  ADD KEY `own_user_id` (`own_user_id`);

--
-- Indexes for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`friend_request_id`),
  ADD KEY `requester` (`requester`),
  ADD KEY `requestee` (`requestee`);

--
-- Indexes for table `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `budget_Instance_id` (`budget_Instance_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`),
  ADD KEY `budget_Instance_ID` (`budget_Instance_ID`),
  ADD KEY `time_line_id` (`time_line_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`preference_id`),
  ADD KEY `currency_id` (`currency_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`savings_id`),
  ADD KEY `time_line_id` (`time_line_id`),
  ADD KEY `budget_Instance_id` (`budget_Instance_id`);

--
-- Indexes for table `time_line`
--
ALTER TABLE `time_line`
  ADD PRIMARY KEY (`time_line_id`),
  ADD KEY `budget_Instance_ID` (`budget_Instance_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_budget_instance`
--
ALTER TABLE `user_budget_instance`
  ADD PRIMARY KEY (`user_budget_Instance_Id`),
  ADD KEY `budget_Instance_ID` (`budget_Instance_ID`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget_instance`
--
ALTER TABLE `budget_instance`
  MODIFY `budget_instance_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `budget_instance_catagory`
--
ALTER TABLE `budget_instance_catagory`
  MODIFY `budget_Instance_catagory_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `category_amounts`
--
ALTER TABLE `category_amounts`
  MODIFY `catergory_amount_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `curency_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friend_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `friend_request_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1117;
--
-- AUTO_INCREMENT for table `goal`
--
ALTER TABLE `goal`
  MODIFY `goal_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `preference`
--
ALTER TABLE `preference`
  MODIFY `preference_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `savings_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `time_line`
--
ALTER TABLE `time_line`
  MODIFY `time_line_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `user_budget_instance`
--
ALTER TABLE `user_budget_instance`
  MODIFY `user_budget_Instance_Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget_instance_catagory`
--
ALTER TABLE `budget_instance_catagory`
  ADD CONSTRAINT `budget_instance_catagory_ibfk_1` FOREIGN KEY (`budget_Instance_id`) REFERENCES `budget_instance` (`budget_instance_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `budget_instance_catagory_ibfk_2` FOREIGN KEY (`catagory_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_amounts`
--
ALTER TABLE `category_amounts`
  ADD CONSTRAINT `category_amounts_ibfk_1` FOREIGN KEY (`time_line_id`) REFERENCES `time_line` (`time_line_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_amounts_ibfk_2` FOREIGN KEY (`catergory_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_state`
--
ALTER TABLE `category_state`
  ADD CONSTRAINT `category_state_ibfk_1` FOREIGN KEY (`time_line_id`) REFERENCES `time_line` (`time_line_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_state_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`own_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friend_request`
--
ALTER TABLE `friend_request`
  ADD CONSTRAINT `friend_request_ibfk_1` FOREIGN KEY (`requester`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friend_request_ibfk_2` FOREIGN KEY (`requestee`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `goal`
--
ALTER TABLE `goal`
  ADD CONSTRAINT `goal_ibfk_1` FOREIGN KEY (`budget_Instance_id`) REFERENCES `budget_instance` (`budget_instance_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`budget_Instance_ID`) REFERENCES `budget_instance` (`budget_instance_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `income_ibfk_2` FOREIGN KEY (`time_line_id`) REFERENCES `time_line` (`time_line_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `income_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preference`
--
ALTER TABLE `preference`
  ADD CONSTRAINT `preference_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preference_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`curency_id`);

--
-- Constraints for table `savings`
--
ALTER TABLE `savings`
  ADD CONSTRAINT `savings_ibfk_1` FOREIGN KEY (`budget_Instance_id`) REFERENCES `budget_instance` (`budget_instance_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `savings_ibfk_2` FOREIGN KEY (`time_line_id`) REFERENCES `time_line` (`time_line_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `time_line`
--
ALTER TABLE `time_line`
  ADD CONSTRAINT `time_line_ibfk_1` FOREIGN KEY (`budget_Instance_ID`) REFERENCES `budget_instance` (`budget_instance_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_budget_instance`
--
ALTER TABLE `user_budget_instance`
  ADD CONSTRAINT `user_budget_instance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_budget_instance_ibfk_2` FOREIGN KEY (`budget_Instance_ID`) REFERENCES `budget_instance` (`budget_instance_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
