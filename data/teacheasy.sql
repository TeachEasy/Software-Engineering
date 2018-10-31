-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2018 at 03:12 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teacheasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

CREATE TABLE `absences` (
  `absences_id` int(15) NOT NULL,
  `student_id` int(15) NOT NULL,
  `school_day_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(15) NOT NULL,
  `subject_id` int(15) NOT NULL,
  `assignment_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE `calendars` (
  `calendar_id` int(15) NOT NULL,
  `teacher_id` int(15) NOT NULL,
  `month` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gradebooks`
--

CREATE TABLE `gradebooks` (
  `gradebook_id` int(15) NOT NULL,
  `gradebook_title` varchar(45) NOT NULL,
  `teacher_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(15) NOT NULL,
  `assignment_id` int(15) NOT NULL,
  `student_id` int(15) NOT NULL,
  `grade` int(3) NOT NULL,
  `gradebook_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plans`
--

CREATE TABLE `lesson_plans` (
  `lesson_plan_id` int(15) NOT NULL,
  `lesson_plan_title` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `objectives` text NOT NULL,
  `information` text NOT NULL,
  `procedure` text NOT NULL,
  `student_instructions` text NOT NULL,
  `resources` text NOT NULL,
  `state_standards` text NOT NULL,
  `notes` text NOT NULL,
  `school_day_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(15) NOT NULL,
  `note_title` varchar(45) NOT NULL,
  `note_description` text NOT NULL,
  `school_day_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_day`
--

CREATE TABLE `school_day` (
  `school_day_id` int(15) NOT NULL,
  `date` date NOT NULL,
  `calendar_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(15) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `teacher_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_lesson_plan`
--

CREATE TABLE `subject_lesson_plan` (
  `lesson_plan_id` int(15) NOT NULL,
  `subject_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_types`
--

CREATE TABLE `subject_types` (
  `subject_id` int(15) NOT NULL,
  `subject_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacaher`
--

CREATE TABLE `teacaher` (
  `teacher_id` int(15) NOT NULL,
  `teacher_username` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `grade` varchar(45) NOT NULL,
  `school_district` int(15) NOT NULL,
  `school_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`absences_id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `school_day_id` (`school_day_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD UNIQUE KEY `subject_id` (`subject_id`),
  ADD UNIQUE KEY `assignment_name` (`assignment_name`);

--
-- Indexes for table `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`calendar_id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `gradebooks`
--
ALTER TABLE `gradebooks`
  ADD PRIMARY KEY (`gradebook_id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD UNIQUE KEY `assignment_id` (`assignment_id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `gradebook_id` (`gradebook_id`);

--
-- Indexes for table `lesson_plans`
--
ALTER TABLE `lesson_plans`
  ADD PRIMARY KEY (`lesson_plan_id`),
  ADD UNIQUE KEY `school_day_id` (`school_day_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD UNIQUE KEY `school_day_id` (`school_day_id`);

--
-- Indexes for table `school_day`
--
ALTER TABLE `school_day`
  ADD PRIMARY KEY (`school_day_id`),
  ADD UNIQUE KEY `calendar_id` (`calendar_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `subject_lesson_plan`
--
ALTER TABLE `subject_lesson_plan`
  ADD PRIMARY KEY (`lesson_plan_id`),
  ADD UNIQUE KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subject_types`
--
ALTER TABLE `subject_types`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- Indexes for table `teacaher`
--
ALTER TABLE `teacaher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `teacher_username` (`teacher_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absences`
--
ALTER TABLE `absences`
  MODIFY `absences_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calendars`
--
ALTER TABLE `calendars`
  MODIFY `calendar_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradebooks`
--
ALTER TABLE `gradebooks`
  MODIFY `gradebook_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson_plans`
--
ALTER TABLE `lesson_plans`
  MODIFY `lesson_plan_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_day`
--
ALTER TABLE `school_day`
  MODIFY `school_day_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_types`
--
ALTER TABLE `subject_types`
  MODIFY `subject_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacaher`
--
ALTER TABLE `teacaher`
  MODIFY `teacher_id` int(15) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
