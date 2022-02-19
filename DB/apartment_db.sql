-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2022 at 02:14 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartment_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Booking_Id` int(11) NOT NULL,
  `Customer_ID` varchar(20) NOT NULL,
  `Room_Id` varchar(20) NOT NULL,
  `Duration` int(5) NOT NULL,
  `Check_In` varchar(20) DEFAULT NULL,
  `Check_Out` varchar(20) DEFAULT NULL,
  `Total` decimal(20,0) NOT NULL,
  `Display_Order` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Booking_Id`, `Customer_ID`, `Room_Id`, `Duration`, `Check_In`, `Check_Out`, `Total`, `Display_Order`) VALUES
(9, '8', '7', 2, '2022-01', '2022-02', '13000', 0),
(10, '9', '1', 9, '2022-02', '2022-10', '27000', 0),
(11, '13', '2', 1, '2022-02', '2022-02', '4500', 0),
(12, '14', '2', 6, '2022-02', '2022-07', '27000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` int(11) NOT NULL,
  `Customer_Name` varchar(30) NOT NULL,
  `Customer_Contact` varchar(30) NOT NULL,
  `Customer_Email` varchar(40) NOT NULL,
  `Customer_ID_Card` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Customer_Name`, `Customer_Contact`, `Customer_Email`, `Customer_ID_Card`) VALUES
(8, 'twsdgasd gdasdfss', '1231231', 'asdf@gmail.com', 'test123'),
(9, 'aaa ccc', '11111', 'aaaa@gmail', 'aaaa1111'),
(13, 'asdf test', '123', 'tset@gmail', 'dfasd2331'),
(14, 'aaa tset', '1231231', 'tset@gmail', 'test1234');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `Room_Id` int(20) NOT NULL,
  `Room_Name` varchar(10) NOT NULL,
  `Room_Type_Id` varchar(20) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`Room_Id`, `Room_Name`, `Room_Type_Id`, `Status`) VALUES
(1, 'A-101', '1', 'Booked'),
(2, 'A-102', '2', 'Booked'),
(3, 'A-103', '2', 'Free'),
(4, 'A-104', '3', 'Free'),
(5, 'A-105', '3', 'Free'),
(6, 'A-106', '1', 'Free'),
(7, 'A-107', '4', 'Free'),
(8, 'B-201', '6', 'Free'),
(9, 'B-202', '2', 'Free'),
(10, 'B-203', '1', 'Free'),
(11, 'B-204', '6', 'Free'),
(12, 'B-205', '5', 'Free'),
(13, 'B-206', '3', 'Free'),
(14, 'B-207', '3', 'Free'),
(16, 'C-302', '6', 'Free'),
(17, 'C-303', '4', 'Free'),
(24, 'C-301', '1', 'Free');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `Room_Type_Id` int(11) NOT NULL,
  `Room_Type_Name` varchar(20) NOT NULL,
  `Room_Type_Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`Room_Type_Id`, `Room_Type_Name`, `Room_Type_Price`) VALUES
(1, 'Single', '3000'),
(2, 'Double ', '4500'),
(3, 'Triple ', '6000'),
(4, 'Family', '6300'),
(5, 'King-Sized', '7000'),
(6, 'Master-Suite', '8000'),
(9, 'Queen-Sized', '6800');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `Shift_Id` int(11) NOT NULL,
  `Shift_Name` varchar(20) NOT NULL,
  `Shift_Time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`Shift_Id`, `Shift_Name`, `Shift_Time`) VALUES
(1, 'Morning', '8:00 AM - 4:00 PM'),
(2, 'Evening', '4:00 PM - 11:00 PM'),
(3, 'Night', '11:00 PM - 8:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_ID` int(11) NOT NULL,
  `Staff_Name` varchar(20) NOT NULL,
  `Staff_Job_Type` varchar(30) NOT NULL,
  `Shift_Id` varchar(30) NOT NULL,
  `Address` varchar(40) NOT NULL,
  `Contact` varchar(20) NOT NULL,
  `Joining_Date` varchar(20) NOT NULL,
  `Salary` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_ID`, `Staff_Name`, `Staff_Job_Type`, `Shift_Id`, `Address`, `Contact`, `Joining_Date`, `Salary`) VALUES
(4, 'test', '2', '2', 'world', '1213212', '2022-02-12', 300),
(5, 'hherlool', '2', '3', 'asdf asf asdf asdfasdf ', '12414242', '2022-02-12', 223);

-- --------------------------------------------------------

--
-- Table structure for table `staff_type`
--

CREATE TABLE `staff_type` (
  `Staff_Job_Type` int(11) NOT NULL,
  `Staff_Job_Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_type`
--

INSERT INTO `staff_type` (`Staff_Job_Type`, `Staff_Job_Name`) VALUES
(1, 'Manager'),
(2, 'Receptionist'),
(3, 'Security Guard'),
(4, 'Cleaner'),
(5, 'Chef'),
(6, 'IT Manager'),
(7, 'Room Attendant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userUid` varchar(50) NOT NULL,
  `userPwd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userUid`, `userPwd`) VALUES
(1, 'Danny Lee', 'test@gmail.com', 'admin', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Booking_Id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`Room_Id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`Room_Type_Id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`Shift_Id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_ID`);

--
-- Indexes for table `staff_type`
--
ALTER TABLE `staff_type`
  ADD PRIMARY KEY (`Staff_Job_Type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `Booking_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `Room_Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `Room_Type_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `Shift_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `Staff_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_type`
--
ALTER TABLE `staff_type`
  MODIFY `Staff_Job_Type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
