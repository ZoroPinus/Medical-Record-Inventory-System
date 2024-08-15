-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 08:52 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uccs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `archivedstudents`
--

CREATE TABLE `archivedstudents` (
  `idno` varchar(112) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `MiddleInitial` char(1) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Suffix` varchar(10) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Address_Street` varchar(100) DEFAULT NULL,
  `Address_City` varchar(50) DEFAULT NULL,
  `Address_State` varchar(50) DEFAULT NULL,
  `ContactNumber` varchar(15) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Education` varchar(50) DEFAULT NULL,
  `Grade` varchar(10) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Course` varchar(50) DEFAULT NULL,
  `MedicalHistory` text DEFAULT NULL,
  `EmergencyContactName` varchar(100) DEFAULT NULL,
  `EmergencyContactNumber` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `archivedteachers`
--

CREATE TABLE `archivedteachers` (
  `idno` varchar(112) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `MiddleInitial` char(1) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Suffix` varchar(10) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Address_Street` varchar(100) DEFAULT NULL,
  `Address_City` varchar(50) DEFAULT NULL,
  `Address_State` varchar(50) DEFAULT NULL,
  `ContactNumber` varchar(15) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Department` varchar(50) DEFAULT NULL,
  `MedicalHistory` text DEFAULT NULL,
  `EmergencyContactName` varchar(100) DEFAULT NULL,
  `EmergencyContactNumber` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bodypartexam`
--

CREATE TABLE `bodypartexam` (
  `body_part_exam_id` int(11) NOT NULL,
  `physical_exam_id` int(11) DEFAULT NULL,
  `body_part` varchar(50) DEFAULT NULL,
  `normal` varchar(10) DEFAULT NULL,
  `abnormal` varchar(10) DEFAULT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dental_health_columns`
--

CREATE TABLE `dental_health_columns` (
  `id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `column1` varchar(255) DEFAULT NULL,
  `column2` int(11) DEFAULT NULL,
  `column3` int(11) DEFAULT NULL,
  `column4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dental_health_records`
--

CREATE TABLE `dental_health_records` (
  `id` int(11) NOT NULL,
  `idno` varchar(112) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `course_grade_section` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `doctor` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_accomplishments`
--

CREATE TABLE `doctor_accomplishments` (
  `id` int(11) NOT NULL,
  `programs` text DEFAULT NULL,
  `success_indicators` text DEFAULT NULL,
  `accomplishments` text DEFAULT NULL,
  `problems` text DEFAULT NULL,
  `actions` text DEFAULT NULL,
  `nurse_name` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `EquipmentID` int(11) NOT NULL,
  `EquipmentName` varchar(100) NOT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  `Status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `firstaidkits`
--

CREATE TABLE `firstaidkits` (
  `FirstAidKitID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Remark` text DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `incidental_reports`
--

CREATE TABLE `incidental_reports` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_number` varchar(112) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_year_grade` varchar(255) DEFAULT NULL,
  `incidence` text NOT NULL,
  `prepared_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `isolation`
--

CREATE TABLE `isolation` (
  `EquipmentID` int(11) NOT NULL,
  `EquipmentName` varchar(100) NOT NULL,
  `Remark` varchar(255) DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `masterlist`
--

CREATE TABLE `masterlist` (
  `ID` int(11) NOT NULL,
  `NoIdNo` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Sex` varchar(10) NOT NULL,
  `Course` varchar(255) NOT NULL,
  `Year` varchar(10) NOT NULL,
  `Unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicalhistory`
--

CREATE TABLE `medicalhistory` (
  `id` int(11) NOT NULL,
  `studentId` varchar(123) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medical_certificates`
--

CREATE TABLE `medical_certificates` (
  `id` int(11) NOT NULL,
  `idno` varchar(112) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `remarks` text DEFAULT NULL,
  `physician_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `licNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `MedicineID` int(11) NOT NULL,
  `Medicine` varchar(100) NOT NULL,
  `Dosage` varchar(100) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ExpirationDate` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_logs`
--

CREATE TABLE `medicine_logs` (
  `log_id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `timeLogged` time DEFAULT current_timestamp(),
  `reason` text DEFAULT NULL,
  `recipient_name` varchar(255) DEFAULT NULL,
  `dosage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `monthly_accomplishments`
--

CREATE TABLE `monthly_accomplishments` (
  `id` int(11) NOT NULL,
  `activities` text NOT NULL,
  `timeSchedule` text NOT NULL,
  `intervention` text NOT NULL,
  `nurse_name` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `onsite_clinical_cases`
--

CREATE TABLE `onsite_clinical_cases` (
  `id` int(11) NOT NULL,
  `illness` varchar(255) DEFAULT NULL,
  `male` int(11) DEFAULT NULL,
  `female` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `nurse_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `physical_exam`
--

CREATE TABLE `physical_exam` (
  `physical_exam_id` int(11) NOT NULL,
  `student_id` varchar(112) DEFAULT NULL,
  `blood_pressure` varchar(20) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `doctor` varchar(122) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(11) NOT NULL,
  `idno` varchar(111) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `MiddleInitial` varchar(100) NOT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Suffix` varchar(100) NOT NULL,
  `Gender` enum('male','female') NOT NULL,
  `Address_Street` varchar(100) DEFAULT NULL,
  `Address_City` varchar(50) DEFAULT NULL,
  `Address_State` varchar(50) DEFAULT NULL,
  `ContactNumber` varchar(100) DEFAULT NULL,
  `Birthday` varchar(100) DEFAULT NULL,
  `Education` varchar(100) DEFAULT NULL,
  `Grade` varchar(100) DEFAULT NULL,
  `Year` varchar(100) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `MedicalHistory` text DEFAULT NULL,
  `EmergencyContactName` varchar(100) DEFAULT NULL,
  `EmergencyContactNumber` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `TeacherID` int(11) NOT NULL,
  `idno` varchar(111) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `MiddleInitial` varchar(100) NOT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Suffix` varchar(100) NOT NULL,
  `Gender` enum('male','female') NOT NULL,
  `Address_Street` varchar(100) DEFAULT NULL,
  `Address_City` varchar(50) DEFAULT NULL,
  `Address_State` varchar(50) DEFAULT NULL,
  `ContactNumber` varchar(100) DEFAULT NULL,
  `Birthday` varchar(100) DEFAULT NULL,
  `Department` varchar(100) DEFAULT NULL,
  `MedicalHistory` text DEFAULT NULL,
  `EmergencyContactName` varchar(100) DEFAULT NULL,
  `EmergencyContactNumber` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','user') NOT NULL,
  `profile_picture` varchar(100) NOT NULL DEFAULT '2.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `loggedinAt` datetime DEFAULT NULL,
  `otp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE `userlogs` (
  `log_id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `First_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Department_Office` varchar(100) DEFAULT NULL,
  `Reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archivedstudents`
--
ALTER TABLE `archivedstudents`
  ADD PRIMARY KEY (`idno`);

--
-- Indexes for table `archivedteachers`
--
ALTER TABLE `archivedteachers`
  ADD PRIMARY KEY (`idno`);

--
-- Indexes for table `bodypartexam`
--
ALTER TABLE `bodypartexam`
  ADD PRIMARY KEY (`body_part_exam_id`);

--
-- Indexes for table `dental_health_columns`
--
ALTER TABLE `dental_health_columns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `record_id` (`record_id`);

--
-- Indexes for table `dental_health_records`
--
ALTER TABLE `dental_health_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_accomplishments`
--
ALTER TABLE `doctor_accomplishments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`EquipmentID`);

--
-- Indexes for table `firstaidkits`
--
ALTER TABLE `firstaidkits`
  ADD PRIMARY KEY (`FirstAidKitID`);

--
-- Indexes for table `incidental_reports`
--
ALTER TABLE `incidental_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `isolation`
--
ALTER TABLE `isolation`
  ADD PRIMARY KEY (`EquipmentID`);

--
-- Indexes for table `masterlist`
--
ALTER TABLE `masterlist`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_certificates`
--
ALTER TABLE `medical_certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`MedicineID`);

--
-- Indexes for table `medicine_logs`
--
ALTER TABLE `medicine_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `monthly_accomplishments`
--
ALTER TABLE `monthly_accomplishments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onsite_clinical_cases`
--
ALTER TABLE `onsite_clinical_cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `physical_exam`
--
ALTER TABLE `physical_exam`
  ADD PRIMARY KEY (`physical_exam_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`TeacherID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
  ADD PRIMARY KEY (`log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bodypartexam`
--
ALTER TABLE `bodypartexam`
  MODIFY `body_part_exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dental_health_columns`
--
ALTER TABLE `dental_health_columns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `dental_health_records`
--
ALTER TABLE `dental_health_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor_accomplishments`
--
ALTER TABLE `doctor_accomplishments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `EquipmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `firstaidkits`
--
ALTER TABLE `firstaidkits`
  MODIFY `FirstAidKitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `incidental_reports`
--
ALTER TABLE `incidental_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `isolation`
--
ALTER TABLE `isolation`
  MODIFY `EquipmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `masterlist`
--
ALTER TABLE `masterlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `medical_certificates`
--
ALTER TABLE `medical_certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `MedicineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicine_logs`
--
ALTER TABLE `medicine_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `monthly_accomplishments`
--
ALTER TABLE `monthly_accomplishments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `onsite_clinical_cases`
--
ALTER TABLE `onsite_clinical_cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `physical_exam`
--
ALTER TABLE `physical_exam`
  MODIFY `physical_exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `TeacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `userlogs`
--
ALTER TABLE `userlogs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dental_health_columns`
--
ALTER TABLE `dental_health_columns`
  ADD CONSTRAINT `dental_health_columns_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `dental_health_records` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
