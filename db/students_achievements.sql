-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2015 at 06:56 AM
-- Server version: 10.0.14-MariaDB-log
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `students_achievements`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE IF NOT EXISTS `achievements` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `points` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `name`, `points`, `teacher_id`) VALUES
(1, 'Посещение на лекция', 10, NULL),
(2, 'Вярно написано домашно', 20, NULL),
(3, 'Участие по време на лекция', 4, 2),
(4, 'Качване на материали от лекции', 20, NULL),
(5, 'Допълване на материалите по лекция', 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE IF NOT EXISTS `specialities` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`id`, `name`) VALUES
(2, 'Информатика'),
(1, 'Компютърни науки');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fn` int(11) NOT NULL,
  `speciality_id` int(11) NOT NULL,
  `flow` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `fn`, `speciality_id`, `flow`, `group`, `class`) VALUES
(1, 4, 80978, 1, 1, 2, 2016),
(2, 5, 60666, 2, 2, 4, 2017),
(3, 6, 80999, 1, 1, 2, 2016),
(4, 7, 80902, 1, 1, 2, 2016),
(5, 8, 60777, 2, 1, 1, 2017);

-- --------------------------------------------------------

--
-- Table structure for table `students_achievements`
--

CREATE TABLE IF NOT EXISTS `students_achievements` (
`id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `achievement_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students_achievements`
--

INSERT INTO `students_achievements` (`id`, `student_id`, `achievement_id`, `teacher_id`, `subject_id`, `points`, `date`) VALUES
(1, 4, 2, 2, 1, 20, '2015-02-06 00:00:00'),
(2, 4, 4, 2, 1, 30, '2015-01-08 10:00:00'),
(3, 5, 5, 3, 2, 8, '2015-02-05 10:00:00'),
(4, 6, 1, 2, 1, 20, '2015-02-03 12:10:00'),
(5, 7, 3, 3, 2, 4, '2015-01-05 17:00:00'),
(6, 4, 2, 2, 1, 20, '2015-02-06 00:00:00'),
(7, 4, 4, 2, 1, 30, '2015-02-05 10:00:00'),
(8, 5, 5, 3, 2, 8, '2015-02-05 10:00:00'),
(9, 6, 1, 2, 1, 20, '2015-02-03 12:10:00'),
(10, 7, 3, 3, 2, 4, '2015-01-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `speciality_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `speciality_id`, `semester`) VALUES
(1, 'Анализ 1', 1, 1),
(2, 'Софтуерни архитектури', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `teachers_subjects`
--

CREATE TABLE IF NOT EXISTS `teachers_subjects` (
`id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers_subjects`
--

INSERT INTO `teachers_subjects` (`id`, `teacher_id`, `subject_id`) VALUES
(1, 2, 2),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `group`) VALUES
(1, 'admin', '123456', 'Иван', 'Иванов', 1),
(2, 'bvasilev', '123456', 'Борис', 'Василев', 2),
(3, 'ana', '123456', 'Ана', 'Иванова', 2),
(4, 'mladen', '123456', 'Младен', 'Василев', 3),
(5, 'tanya', '123456', 'Таня', 'Темелкова', 3),
(6, 'maria', '123456', 'Мария', 'Олегова', 3),
(7, 'vasilv', '123456', 'Васил', 'Василев', 3),
(8, 'yana', '123456', 'Яна', 'Руменова', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
 ADD PRIMARY KEY (`id`), ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `fn` (`fn`), ADD KEY `user_id` (`user_id`), ADD KEY `speciality_id` (`speciality_id`);

--
-- Indexes for table `students_achievements`
--
ALTER TABLE `students_achievements`
 ADD PRIMARY KEY (`id`), ADD KEY `student_id` (`student_id`), ADD KEY `achievement_id` (`achievement_id`), ADD KEY `teacher_id` (`teacher_id`), ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
 ADD PRIMARY KEY (`id`), ADD KEY `speciality_id` (`speciality_id`);

--
-- Indexes for table `teachers_subjects`
--
ALTER TABLE `teachers_subjects`
 ADD PRIMARY KEY (`id`), ADD KEY `teacher_id` (`teacher_id`), ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `specialities`
--
ALTER TABLE `specialities`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `students_achievements`
--
ALTER TABLE `students_achievements`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teachers_subjects`
--
ALTER TABLE `teachers_subjects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievements`
--
ALTER TABLE `achievements`
ADD CONSTRAINT `achievements_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`speciality_id`) REFERENCES `specialities` (`id`);

--
-- Constraints for table `students_achievements`
--
ALTER TABLE `students_achievements`
ADD CONSTRAINT `students_achievements_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `students_achievements_ibfk_2` FOREIGN KEY (`achievement_id`) REFERENCES `achievements` (`id`),
ADD CONSTRAINT `students_achievements_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `students_achievements_ibfk_4` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`speciality_id`) REFERENCES `specialities` (`id`);

--
-- Constraints for table `teachers_subjects`
--
ALTER TABLE `teachers_subjects`
ADD CONSTRAINT `teachers_subjects_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `teachers_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
