-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2017 at 01:20 PM
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
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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

-- --------------------------------------------------------

--
-- Table structure for table `category_state`
--

CREATE TABLE `category_state` (
  `state` enum('active','deactivated','removed','') NOT NULL DEFAULT 'active',
  `time_line_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(11) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `status` enum('active','deactivated') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preference`
--

CREATE TABLE `preference` (
  `preference_id` int(11) UNSIGNED NOT NULL,
  `currency_id` int(11) UNSIGNED NOT NULL DEFAULT '1',
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`),
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
  MODIFY `budget_instance_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `budget_instance_catagory`
--
ALTER TABLE `budget_instance_catagory`
  MODIFY `budget_Instance_catagory_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `category_amounts`
--
ALTER TABLE `category_amounts`
  MODIFY `catergory_amount_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `curency_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friend_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `friend_request_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1124;
--
-- AUTO_INCREMENT for table `goal`
--
ALTER TABLE `goal`
  MODIFY `goal_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `preference`
--
ALTER TABLE `preference`
  MODIFY `preference_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `savings`
--
ALTER TABLE `savings`
  MODIFY `savings_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `time_line`
--
ALTER TABLE `time_line`
  MODIFY `time_line_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `user_budget_instance`
--
ALTER TABLE `user_budget_instance`
  MODIFY `user_budget_Instance_Id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
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
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
