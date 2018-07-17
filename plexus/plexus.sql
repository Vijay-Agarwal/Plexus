-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2018 at 11:58 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plexus`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`user_id`, `friend_id`) VALUES
(14, 15),
(14, 17),
(14, 18),
(14, 16),
(15, 14),
(19, 14),
(16, 14),
(17, 14),
(15, 18),
(18, 15),
(16, 17),
(17, 16),
(20, 14),
(21, 16),
(21, 17),
(21, 18),
(21, 20),
(21, 14),
(14, 21),
(15, 19),
(21, 15),
(16, 15);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `message` varchar(30) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notif_id`, `user_id`, `friend_id`, `message`, `type`, `post_id`) VALUES
(6, 19, 14, 'Added a new post', 1, 47),
(7, 16, 14, 'Added a new post', 1, 47),
(8, 17, 14, 'Added a new post', 1, 47),
(15, 18, 15, 'Added a new post', 1, 49),
(19, 19, 14, 'Liked your post', 2, 51),
(20, 19, 14, 'Commented your post', 3, 51),
(30, 16, 21, 'Started Following You.', 0, NULL),
(31, 17, 21, 'Started Following You.', 0, NULL),
(32, 18, 21, 'Started Following You.', 0, NULL),
(33, 20, 21, 'Started Following You.', 0, NULL),
(35, 21, 14, 'Started Following You.', 0, NULL),
(37, 19, 14, 'Added a new post', 1, 52),
(38, 16, 14, 'Added a new post', 1, 52),
(39, 17, 14, 'Added a new post', 1, 52),
(40, 20, 14, 'Added a new post', 1, 52),
(41, 21, 14, 'Added a new post', 1, 52),
(85, 19, 14, 'Added a new post', 1, 84),
(86, 16, 14, 'Added a new post', 1, 84),
(87, 17, 14, 'Added a new post', 1, 84),
(88, 20, 14, 'Added a new post', 1, 84),
(89, 21, 14, 'Added a new post', 1, 84),
(90, 19, 15, 'Started Following You.', 0, NULL),
(93, 19, 14, 'Liked your post', 2, 83),
(96, 18, 15, 'Added a new post', 1, 85),
(97, 21, 15, 'Added a new post', 1, 85),
(107, 18, 15, 'Added new notes', 4, 95),
(108, 21, 15, 'Added new notes', 4, 95),
(109, 16, 15, 'Added new notes', 4, 95),
(111, 17, 16, 'Added new notes', 4, 96),
(112, 21, 16, 'Added new notes', 4, 96),
(116, 19, 14, 'Added new notes', 4, 98),
(117, 16, 14, 'Added new notes', 4, 98),
(118, 17, 14, 'Added new notes', 4, 98),
(119, 20, 14, 'Added new notes', 4, 98),
(120, 21, 14, 'Added new notes', 4, 98),
(122, 19, 14, 'Added new notes', 4, 99),
(123, 16, 14, 'Added new notes', 4, 99),
(124, 17, 14, 'Added new notes', 4, 99),
(125, 20, 14, 'Added new notes', 4, 99),
(126, 21, 14, 'Added new notes', 4, 99),
(128, 19, 14, 'Added new notes', 4, 100),
(129, 16, 14, 'Added new notes', 4, 100),
(130, 17, 14, 'Added new notes', 4, 100),
(131, 20, 14, 'Added new notes', 4, 100),
(132, 21, 14, 'Added new notes', 4, 100),
(136, 19, 14, 'Added a new post', 1, 102),
(137, 16, 14, 'Added a new post', 1, 102),
(138, 17, 14, 'Added a new post', 1, 102),
(139, 20, 14, 'Added a new post', 1, 102),
(140, 21, 14, 'Added a new post', 1, 102),
(141, 14, 15, 'Liked your post', 2, 102);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(300) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `dep` int(11) NOT NULL DEFAULT '0',
  `sem` int(11) NOT NULL DEFAULT '0',
  `notes_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `message`, `type`, `dep`, `sem`, `notes_link`) VALUES
(47, 14, 'Hi everyone. I am Rahul Bansal', 0, 0, 0, NULL),
(49, 15, 'First post by me', 0, 0, 0, NULL),
(51, 19, 'Hello buddies! I am piyush from delhi', 0, 0, 0, NULL),
(52, 14, 'Hi Debo', 0, 0, 0, NULL),
(83, 19, 'Happy new year', 0, 0, 0, NULL),
(84, 14, '', 0, 0, 0, NULL),
(85, 15, 'InnovateTech Fest2k18', 0, 0, 0, NULL),
(95, 15, 'Machine learning', 1, 1, 5, 'https://drive.google.com/drive/folders/0B_aYdUvyBA72b3RfTllDd1R4ekU'),
(96, 16, 'Theory of computation', 1, 1, 5, 'https://drive.google.com/drive/folders/0B_aYdUvyBA72M09uZWFOdzJHRWc'),
(97, 19, 'Operating System', 1, 1, 5, 'https://drive.google.com/drive/folders/0B_aYdUvyBA72aTNwcUZZVlZId1k'),
(98, 14, 'IT notes', 1, 1, 1, 'https://drive.google.com/file/d/0B4D9hVkBdWVIUU42bHpZbnVfTm0xLUJFSHJ5SGNYRXgzVHo0/view'),
(99, 14, 'Computer Networks', 1, 1, 5, 'https://drive.google.com/drive/folders/0B_aYdUvyBA72WDk3RVluR0k0TWc'),
(100, 14, 'Advanced java', 1, 1, 5, 'https://drive.google.com/drive/folders/0B_aYdUvyBA72Qm91SmkwUzNiZWs'),
(101, 19, 'India!!!', 0, 0, 0, NULL),
(102, 14, 'SRM LAB 6', 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE `post_comment` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_comment`
--

INSERT INTO `post_comment` (`post_id`, `user_id`, `comment`) VALUES
(47, 15, 'Hi rahul'),
(47, 17, 'Hello rahul!! wassup'),
(47, 19, 'hey buddy'),
(47, 14, 'I am fine.'),
(51, 14, 'Hello piyush'),
(47, 19, 'I am also fine'),
(47, 18, 'Hi !!! I am yaduvir'),
(47, 14, 'Hello yaduvir'),
(49, 18, 'Hello vijay'),
(84, 15, 'Same to you');

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`post_id`, `user_id`) VALUES
(47, 17),
(47, 19),
(51, 19),
(51, 14),
(49, 18),
(47, 18),
(47, 14),
(47, 21),
(52, 21),
(84, 15),
(83, 14),
(85, 14),
(102, 14),
(102, 15);

-- --------------------------------------------------------

--
-- Table structure for table `post_pic`
--

CREATE TABLE `post_pic` (
  `post_id` int(11) NOT NULL,
  `postImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_pic`
--

INSERT INTO `post_pic` (`post_id`, `postImage`) VALUES
(51, 'images/avatar.png'),
(83, 'images/Happy-New-Year-2018-Images-4.jpg'),
(84, 'images/happy-new-year-2018-in-blue-and-pink-letters_23-2147720684.jpg'),
(85, 'images/DXSx3OAWAAAWWhD.jpg'),
(101, 'images/download.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `dob` date NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `profileImage` varchar(255) NOT NULL DEFAULT 'images/defaultProfileImage.png',
  `coverImage` varchar(255) NOT NULL DEFAULT 'images/defaultCoverImage.png	',
  `bio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `active`, `name`, `email`, `password`, `dob`, `mobile`, `profileImage`, `coverImage`, `bio`) VALUES
(14, 0, 'Rahul Bansal', 'rahul@gmail.com', 'rahul', '1998-04-12', 8881135171, 'images/alphabet/r.jpeg', 'images/defaultCoverImage.png	', 'Student of CSE-F'),
(15, 0, 'Vijay Agarwal', 'vijay@gmail.com', 'vijay', '1997-08-28', 9997778880, 'images/alphabet/v.jpeg', 'images/defaultCoverImage.png	', NULL),
(16, 0, 'Pranjal Sabherwal', 'pranjal@gmail.com', 'pranjal', '1997-01-01', 9997778881, 'images/alphabet/p.jpeg', 'images/defaultCoverImage.png	', NULL),
(17, 0, 'Devang Sharma', 'devang@gmail.com', 'devang', '1998-03-16', 9988779988, 'images/alphabet/d.jpeg', 'images/defaultCoverImage.png	', NULL),
(18, 0, 'Yaduvir Singh', 'yaduvir@gmail.com', 'yaduvir', '1996-10-18', 9999888877, 'images/alphabet/y.jpeg', 'images/defaultCoverImage.png	', NULL),
(19, 0, 'Piyush Garg', 'piyush@gmail.com', 'piyush', '1998-05-08', 8765432190, 'images/alphabet/p.jpeg', 'images/defaultCoverImage.png	', NULL),
(20, 0, 'Vibhor Gupta', 'vibhor@gmail.com', 'vibhor', '1998-10-10', 4455667788, 'images/alphabet/v.jpeg', 'images/defaultCoverImage.png	', NULL),
(21, 0, 'Debjyoti', 'debjyoti@gmail.com', 'debjyoti', '1998-02-27', 9958072269, 'images/alphabet/d.jpeg', 'images/cover1.png', 'Cyka Blyat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD KEY `friend_id` (`friend_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `friend_id` (`friend_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_pic`
--
ALTER TABLE `post_pic`
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`friend_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`friend_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD CONSTRAINT `post_comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `post_like`
--
ALTER TABLE `post_like`
  ADD CONSTRAINT `post_like_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `post_like_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `post_pic`
--
ALTER TABLE `post_pic`
  ADD CONSTRAINT `post_pic_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
