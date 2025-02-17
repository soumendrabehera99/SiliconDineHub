-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2025 at 02:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silicon_dinehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`email`, `name`, `password`) VALUES
('admin1@gmail.com', 'Admin1', '123'),
('admin2@gmail.com', 'Admin2', '456'),
('admin3@gmail.com', 'Admin3', '789'),
('admin@gmail.com', 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `counterID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`counterID`, `userName`, `password`, `status`) VALUES
(1, 'counter1', '123', '1'),
(2, 'counter2', '456', '1'),
(3, 'counter3', '789', '0');

-- --------------------------------------------------------

--
-- Table structure for table `counter_category`
--

CREATE TABLE `counter_category` (
  `counterCategoryID` int(11) NOT NULL,
  `counterID` int(11) DEFAULT NULL,
  `foodCategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counter_category`
--

INSERT INTO `counter_category` (`counterCategoryID`, `counterID`, `foodCategoryID`) VALUES
(1, 1, 1),
(2, 2, NULL),
(3, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` int(11) NOT NULL,
  `studentID` int(11) DEFAULT NULL,
  `feedback` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `status` varchar(5) NOT NULL,
  `feedbackFor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `studentID`, `feedback`, `rating`, `status`, `feedbackFor`) VALUES
(1, 1, 'Great food quality!', '5', '1', 'Cafeteria'),
(2, 2, 'Needs improvement in service.', '3', '1', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `foodID` int(11) NOT NULL,
  `foodCategoryID` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `isAvailable` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`foodID`, `foodCategoryID`, `name`, `description`, `price`, `isAvailable`) VALUES
(1, 1, 'Cappuccino', 'Hot coffee with milk foam', '100', '1'),
(2, NULL, 'Burger', 'Cheese and lettuce burger', '150', '1'),
(3, NULL, 'Blueberry Muffins', 'Blueberry muffins are sweet, moist, and bursting with blueberries.', '50', '1'),
(4, 12, 'Fried rice', 'Fried rice is a dish of cooked rice that has been stir-fried in a wok or a frying pan and is usually mixed with other ingredients such as eggs, vegetables, seafood, or meat', '60', '1');

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `foodCategoryID` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`foodCategoryID`, `category`) VALUES
(1, 'Beverages'),
(12, 'Chinese'),
(13, 'South Indian'),
(14, 'Dairy');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `orderID` int(11) NOT NULL,
  `studentID` int(11) DEFAULT NULL,
  `foodID` int(11) DEFAULT NULL,
  `quantity` varchar(255) NOT NULL,
  `orderType` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`orderID`, `studentID`, `foodID`, `quantity`, `orderType`, `price`, `createdAt`, `updatedAt`, `status`) VALUES
(1, 1, 1, '2', 'Dine-in', '200', '2025-02-12', '2025-02-12', '1'),
(2, 2, 2, '1', 'Takeaway', '150', '2025-02-11', '2025-02-11', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sic_email`
--

CREATE TABLE `sic_email` (
  `seID` int(11) NOT NULL,
  `sic` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sic_email`
--

INSERT INTO `sic_email` (`seID`, `sic`, `email`) VALUES
(1, '23mmci37', 'mca.23mmci37@silicon.ac.in'),
(2, '23mmci48', 'mca.23mmci48@silicon.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `sic` varchar(255) NOT NULL,
  `seID` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `sic`, `seID`, `name`, `dob`, `password`, `status`) VALUES
(1, 'mca.23mmci37@silicon.ac.in', 1, 'Anil Sahu', '2002-10-10', '1234', '1'),
(2, 'mca.23mmci48@silicon.ac.in', 2, 'Soumendra', '2000-08-20', '5678', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`counterID`);

--
-- Indexes for table `counter_category`
--
ALTER TABLE `counter_category`
  ADD PRIMARY KEY (`counterCategoryID`),
  ADD KEY `fk_counter_id` (`counterID`),
  ADD KEY `fk_fc_id` (`foodCategoryID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`),
  ADD KEY `fk_st_id` (`studentID`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`foodID`),
  ADD KEY `fk_foodcategory_id` (`foodCategoryID`);

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`foodCategoryID`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `fk_food_id` (`foodID`),
  ADD KEY `fk_student_id` (`studentID`);

--
-- Indexes for table `sic_email`
--
ALTER TABLE `sic_email`
  ADD PRIMARY KEY (`seID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `fk_se_id` (`seID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `counterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `counter_category`
--
ALTER TABLE `counter_category`
  MODIFY `counterCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `foodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `foodCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sic_email`
--
ALTER TABLE `sic_email`
  MODIFY `seID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `counter_category`
--
ALTER TABLE `counter_category`
  ADD CONSTRAINT `fk_counter_id` FOREIGN KEY (`counterID`) REFERENCES `counter` (`counterID`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_fc_id` FOREIGN KEY (`foodCategoryID`) REFERENCES `food_category` (`foodCategoryID`) ON DELETE SET NULL;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_st_id` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE SET NULL;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `fk_foodcategory_id` FOREIGN KEY (`foodCategoryID`) REFERENCES `food_category` (`foodCategoryID`) ON DELETE SET NULL;

--
-- Constraints for table `order_table`
--
ALTER TABLE `order_table`
  ADD CONSTRAINT `fk_food_id` FOREIGN KEY (`foodID`) REFERENCES `food` (`foodID`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE SET NULL;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_se_id` FOREIGN KEY (`seID`) REFERENCES `sic_email` (`seID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
