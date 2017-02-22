-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2017 at 06:48 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `comment_id` int(25) NOT NULL,
  `comment_detail` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`comment_id`, `comment_detail`, `user_id`, `thread_id`, `created`, `updated`, `deleted`) VALUES
(1, '<p><font style="background-color: rgb(255, 156, 0);" color="#ffffff">cccccdddd ddddd</font></p>', 1, 1, '2017-02-22 11:44:47', '2017-02-22 11:44:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_threads`
--

CREATE TABLE `tbl_threads` (
  `thread_id` int(25) NOT NULL,
  `thread_title` varchar(150) NOT NULL,
  `thread_description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(25) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_threads`
--

INSERT INTO `tbl_threads` (`thread_id`, `thread_title`, `thread_description`, `user_id`, `topic_id`, `created`, `updated`, `deleted`) VALUES
(1, 'About Hot Dog', '<p><img src="uploads/images/forum-thread-20170222064038.jpg" style="width: 50%;"><br></p><p><b><u style="background-color: rgb(255, 0, 0);">I love Hot Dog</u></b></p>', 1, 1, '2017-02-22 11:41:06', '2017-02-22 11:41:06', 0),
(2, 'This is a Demo', '<p><b>Lovely day guy''s</b></p>', 2, 2, '2017-02-22 11:47:36', '2017-02-22 11:47:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topics`
--

CREATE TABLE `tbl_topics` (
  `topic_id` int(11) NOT NULL,
  `topic_title` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_topics`
--

INSERT INTO `tbl_topics` (`topic_id`, `topic_title`, `user_id`, `created`, `updated`, `deleted`) VALUES
(1, 'Food', 1, '2017-02-22 11:39:44', '2017-02-22 11:39:44', 0),
(2, 'Demo Test', 2, '2017-02-22 11:47:14', '2017-02-22 11:47:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(25) NOT NULL,
  `user_fname` varchar(100) NOT NULL,
  `user_lname` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_lname`, `user_name`, `user_email`, `user_password`, `user_image`, `user_status`, `created`, `updated`, `deleted`) VALUES
(1, 'Tj', 'Thouhid', 'tjthouhid', 'tjthouhid@gmail.com', '169141a9d48b3bc6272420bba299741b778597630fd7f4b86d5ea262c0ca024eafa6898aa43db4707ecacc4ab5e545ca2576dc426858201b9626bf8f7846c5ad', 'forum-user-20170222063906.jpg', 'active', '2017-02-22 11:39:06', '2017-02-22 11:39:06', 0),
(2, 'Nazrul', ' Islam', 'nazrul001', 'nazrulislam@gmail.com', '169141a9d48b3bc6272420bba299741b778597630fd7f4b86d5ea262c0ca024eafa6898aa43db4707ecacc4ab5e545ca2576dc426858201b9626bf8f7846c5ad', 'forum-user-20170222064616.jpg', 'active', '2017-02-22 11:46:16', '2017-02-22 11:46:16', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tbl_threads`
--
ALTER TABLE `tbl_threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `tbl_topics`
--
ALTER TABLE `tbl_topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `comment_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_threads`
--
ALTER TABLE `tbl_threads`
  MODIFY `thread_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_topics`
--
ALTER TABLE `tbl_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
