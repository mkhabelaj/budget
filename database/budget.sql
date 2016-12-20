-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2016 at 02:36 PM
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
(50, 'test1', ''),
(52, 'test3', ''),
(53, 'test2', ''),
(54, 'dyfgkgikfi', ''),
(55, 'dfg', ''),
(56, 'sdf', ''),
(57, 'hklhjjl', ''),
(58, 'fjlgjl', ''),
(59, 'sdfsdfasfasfsafasfsa', ''),
(60, 'dgfkhfhkghkdgfhkhf', ''),
(64, 'dgdfg', ''),
(65, 'dykdk', ''),
(66, 'test 3', ''),
(67, 'test 4', ''),
(68, 'test 5', '');

-- --------------------------------------------------------

--
-- Table structure for table `budget_instance_catagory`
--

CREATE TABLE `budget_instance_catagory` (
  `budget_Instance_catagory_id` int(11) UNSIGNED NOT NULL,
  `catagory_id` int(11) UNSIGNED NOT NULL,
  `budget_Instance_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL,
  `status` enum('on','off') NOT NULL DEFAULT 'on',
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category_amounts`
--

CREATE TABLE `category_amounts` (
  `catergory_amount_id` int(11) UNSIGNED NOT NULL,
  `actual_amount` double NOT NULL,
  `projected_amount` double NOT NULL,
  `catergory_id` int(11) UNSIGNED NOT NULL,
  `time_line_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(43, 'friend', 48, 49),
(44, 'friend', 49, 48),
(45, 'friend', 27, 49),
(46, 'friend', 49, 27),
(47, 'friend', 33, 49),
(48, 'friend', 49, 33),
(49, 'friend', 52, 49),
(50, 'friend', 49, 52),
(51, 'friend', 50, 49),
(52, 'friend', 49, 50),
(53, 'friend', 48, 50),
(54, 'friend', 50, 48),
(55, 'friend', 50, 27),
(56, 'friend', 27, 50),
(57, 'friend', 52, 50),
(58, 'friend', 50, 52),
(59, 'friend', 33, 50),
(60, 'friend', 50, 33),
(65, 'friend', 52, 33),
(66, 'friend', 33, 52),
(67, 'friend', 27, 33),
(68, 'friend', 33, 27);

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
(64, 49, 48, 'accepted'),
(65, 49, 50, 'accepted'),
(66, 49, 27, 'accepted'),
(67, 49, 33, 'accepted'),
(68, 49, 52, 'accepted'),
(69, 50, 48, 'accepted'),
(70, 27, 50, 'accepted'),
(71, 50, 52, 'accepted'),
(72, 50, 33, 'accepted'),
(75, 33, 52, 'accepted'),
(76, 33, 27, 'accepted');

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
  `income` double NOT NULL,
  `budget_Instance_ID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `income`, `budget_Instance_ID`) VALUES
(34, 5000, 50),
(36, 200000, 52),
(37, 456, 53),
(38, 45, 54),
(39, 456456, 55),
(40, 456456, 56),
(41, 456, 57),
(42, 45654, 58),
(43, 456456, 59),
(44, 456, 60),
(48, 4565, 64),
(49, 456456, 65),
(50, 10000, 66),
(51, 545456, 67),
(52, 5645454, 68);

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
(1, 'you request has be accepted from your friend adolf adolf', 33, 'seen'),
(2, 'you request has be accepted from your friend admin admin', 33, 'seen');

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
(33, '2016-12-22', '2017-01-22', 'monthly', 'active', 22, 50),
(35, '2016-12-19', '2016-12-26', 'weekly', 'active', 0, 52),
(36, '2016-12-01', '2016-12-15', 'biweekly', 'active', 0, 53),
(37, '2016-12-19', '2017-01-19', 'monthly', 'active', 19, 54),
(38, '2016-11-01', '2016-12-01', 'monthly', 'active', 1, 55),
(39, '2016-06-01', '2016-07-01', 'monthly', 'active', 0, 56),
(40, '2016-12-20', '2017-01-20', 'monthly', 'active', 20, 57),
(41, '2016-10-19', '2016-11-19', 'monthly', 'active', 19, 58),
(42, '2016-12-02', '2017-01-02', 'monthly', 'active', 2, 59),
(43, '2016-11-02', '2016-12-02', 'monthly', 'active', 2, 60),
(47, '2016-12-17', '2017-01-17', 'monthly', 'active', 17, 64),
(48, '2016-12-08', '2016-12-15', 'weekly', 'active', 0, 65),
(49, '2016-01-31', '2016-02-29', 'monthly', 'active', 31, 66),
(50, '2015-12-30', '2016-01-30', 'monthly', 'active', 30, 67),
(51, '2016-07-31', '2016-08-31', 'monthly', 'active', 31, 68);

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
(52, 'adolf', 'adolf', 'adolf@adolf.com', '2016-12-07 12:30:45', 'UJFpC7HYzBSBsO+VBNT4Fw==', 'male', 'strd');

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
(67, 50, 33),
(69, 52, 33),
(70, 53, 33),
(71, 54, 33),
(72, 55, 33),
(73, 56, 33),
(77, 60, 33),
(81, 64, 33),
(82, 65, 33),
(83, 66, 33),
(84, 67, 33),
(85, 68, 33);

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
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_amounts`
--
ALTER TABLE `category_amounts`
  ADD PRIMARY KEY (`catergory_amount_id`),
  ADD KEY `catergory_id` (`catergory_id`),
  ADD KEY `time_line_id` (`time_line_id`);

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
  ADD KEY `budget_Instance_ID` (`budget_Instance_ID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
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
  MODIFY `budget_instance_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `budget_instance_catagory`
--
ALTER TABLE `budget_instance_catagory`
  MODIFY `budget_Instance_catagory_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category_amounts`
--
ALTER TABLE `category_amounts`
  MODIFY `catergory_amount_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friend_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `friend_request_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `goal`
--
ALTER TABLE `goal`
  MODIFY `goal_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `savings_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `time_line`
--
ALTER TABLE `time_line`
  MODIFY `time_line_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `user_budget_instance`
--
ALTER TABLE `user_budget_instance`
  MODIFY `user_budget_Instance_Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
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
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`budget_Instance_ID`) REFERENCES `budget_instance` (`budget_instance_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
