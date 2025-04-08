-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 09:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(1, NULL, NULL),
(2, NULL, NULL),
(3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counter_table`
--

CREATE TABLE `counter_table` (
  `counterID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counter_table`
--

INSERT INTO `counter_table` (`counterID`, `userName`, `password`, `status`) VALUES
(1, 'Counter1', '1234', '1'),
(2, 'Counter2', '2222', '0'),
(3, 'Soumendra', '2000', '1'),
(4, 'Priti Samarpta', '2001', '1'),
(5, 'Anil', '2002', '1');

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

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `foodID` int(11) NOT NULL,
  `foodCategoryID` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `isAvailable` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`foodID`, `foodCategoryID`, `name`, `image`, `description`, `price`, `type`, `isAvailable`) VALUES
(2, 1, 'Espresso', 'food_67e56945f26435.64229712.jpeg', 'A strong and bold black coffee made from finely ground beans, delivering an intense caffeine kick and deep aroma, ideal for a quick energy boost.', 80.00, 'VEG', '1'),
(3, 2, 'Fried Rice', 'food_67e569b7670c61.92487798.jpeg', 'Stir-fried rice cooked with fresh vegetables, scrambled eggs, and soy sauce, creating a deliciously savory and aromatic dish that pairs well with spicy sides.', 120.00, 'VEG', '1'),
(5, 8, 'Greek Salad', 'food_67e56cb93f2e82.15304669.jpeg', 'A fresh mix of feta cheese, olives, tomatoes, cucumbers, and herbs, drizzled with olive oil for extra flavor, making it a nutritious and tasty meal.', 160.00, 'VEG', '1'),
(6, 7, 'Croissant', 'food_67e56cef9d5f95.49322435.jpeg', 'A buttery and flaky French pastry with a crisp golden crust, best enjoyed fresh with a cup of coffee for a perfect morning or evening snack.', 90.00, 'VEG', '1'),
(7, 7, 'Banana Bread', 'food_67e56d2c5e73e1.26837434.jpeg', 'A moist and sweet homemade bread infused with ripe bananas, offering a deliciously soft and comforting treat that pairs well with tea or coffee.', 90.00, 'VEG', '1'),
(9, 3, 'Curd Rice', 'food_67e56db15852a3.15008181.jpeg', 'A refreshing South Indian dish made with rice, yogurt, and mild spices, providing a cooling and light taste that is perfect for hot summer days.', 80.00, 'VEG', '1'),
(10, 11, 'Burrito', 'food_67e56ea896fb57.87500653.jpeg', 'A large stuffed wrap with rice, beans, cheese, meat, and a flavorful sauce, wrapped in a warm tortilla, creating a hearty and filling meal.', 190.00, 'VEG', '1'),
(11, 8, 'Caesar Salad', 'food_67e56f01198a16.08127897.jpeg', 'Crisp lettuce tossed with parmesan cheese, croutons, and a creamy dressing, creating a refreshing and crunchy dish perfect as a starter or side.', 150.00, 'VEG', '1'),
(12, 5, 'Cheeseburger', 'food_67e56f47d50850.47830031.jpeg', 'A juicy grilled beef patty topped with melted cheese, fresh lettuce, tomato, and onions, all in a toasted bun, offering a deliciously filling fast food treat.', 150.00, 'NON-VEG', '1'),
(16, 16, 'Pani Puri', 'food_67ee86855da560.00656821.jpeg', 'Crispy, hollow puris filled with a flavorful mix of mashed potatoes, chickpeas, and tangy tamarind chutney, served with spicy mint-flavored water for a burst of taste.', 40.00, 'VEG', '1'),
(17, 17, 'Chicken Korma', 'food_67ee86e455ee71.97520289.jpeg', 'Rich and creamy Mughlai dish made with chicken, yogurt, and spices', 140.00, 'NON-VEG', '1'),
(18, 18, 'Dal Baati Churma', 'food_67ee870d30a5e0.05650788.jpeg', 'Traditional Rajasthani dish with baked wheat balls, lentils, and sweet churma', 120.00, 'VEG', '1'),
(19, 15, 'Vegan Buddha Bowl', 'food_67ee88cf117e73.27309639.jpeg', 'A nourishing mix of quinoa, chickpeas, roasted sweet potatoes, avocado, and crunchy vegetables, topped with a tangy tahini dressing for a wholesome vegan meal.', 180.00, 'VEG', '1'),
(20, 14, 'Grilled Chicken', 'food_67ee891f2fec15.87978915.jpeg', 'Tender, juicy chicken breast marinated with aromatic herbs, garlic, and smoky spices, grilled to perfection and served with a side of fresh salad and tangy dip', 220.00, 'NON-VEG', '1'),
(21, 6, 'Chocolate Lava Cake', 'food_67ee89aad3b526.54776211.jpeg', 'A warm and indulgent dessert with a crisp outer layer and a molten, gooey chocolate center, baked to perfection and served with vanilla ice cream or berries.', 120.00, 'NON-VEG', '1'),
(22, 9, 'Tomato Basil Soup', 'food_67ee89d5800d14.12151562.jpeg', 'A smooth and flavorful soup made from slow-roasted tomatoes, fresh basil, garlic, and olive oil, blended into a creamy texture and served with crispy croutons.', 35.00, 'NON-VEG', '1'),
(23, 10, 'Grilled Salmon', 'food_67ee8a1950d8f4.04811960.jpeg', 'Fresh salmon fillet marinated with garlic, lemon, and herbs, grilled to perfection for a crispy exterior and juicy interior, served with sautéed vegetables', 180.00, 'NON-VEG', '1'),
(24, 12, 'Margherita Pizza', 'food_67ee8a7d8d10a8.10934343.jpeg', 'Classic Italian pizza with tomato sauce, fresh mozzarella & basil', 200.00, 'VEG', '0'),
(25, 13, 'Aloo Paratha', 'food_67ee8c594c4f10.75072998.jpeg', 'Whole wheat flatbread stuffed with a deliciously spiced mashed potato filling, cooked on a griddle with butter and served with yogurt, pickles, and chutney.', 15.00, 'VEG', '1'),
(26, 4, 'Sweet Curd', 'food_67ee8c8184e211.48761397.jpeg', 'A creamy and luscious Bengali dessert made by fermenting thickened milk with caramelized sugar, creating a naturally sweet, rich, and velvety-textured yogurt.', 20.00, 'VEG', '1');

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
(2, 'Chinese'),
(3, 'South Indian'),
(4, 'Dairy'),
(5, 'Fast Food'),
(6, 'Desserts'),
(7, 'Bakery'),
(8, 'Salads'),
(9, 'Soups'),
(10, 'Seafood'),
(11, 'Mexican'),
(12, 'Italian'),
(13, 'Breakfast'),
(14, 'Grilled'),
(15, 'Vegan'),
(16, 'Chaat'),
(17, 'Mughlai'),
(18, 'Rajasthani');

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
(1, 2, 3, '2', 'Takeaway', '240.00', '2025-04-01', '2025-04-01', 'D'),
(2, 3, 5, '1', 'Dine-In', '160.00', '2025-04-02', '2025-04-02', 'P'),
(3, 4, 7, '1', 'Takeaway', '90.00', '2025-04-03', '2025-04-03', 'D'),
(4, 5, 2, '1', 'Dine-In', '80.00', '2025-04-03', '2025-04-03', 'C'),
(5, 6, 9, '3', 'Takeaway', '240.00', '2025-04-04', '2025-04-04', 'P'),
(6, 7, 12, '2', 'Dine-In', '300.00', '2025-04-05', '2025-04-05', 'D'),
(7, 8, 16, '1', 'Takeaway', '40.00', '2025-04-06', '2025-04-06', 'C'),
(8, 10, 17, '1', 'Dine-In', '140.00', '2025-04-06', '2025-04-06', 'D'),
(9, 12, 18, '1', 'Takeaway', '120.00', '2025-04-07', '2025-04-07', 'P'),
(10, 13, 20, '2', 'Dine-In', '440.00', '2025-04-07', '2025-04-07', 'D'),
(11, 15, 19, '1', 'Takeaway', '180.00', '2025-04-08', '2025-04-08', 'P'),
(12, 17, 22, '2', 'Dine-In', '70.00', '2025-04-08', '2025-04-08', 'C'),
(13, 19, 25, '3', 'Takeaway', '45.00', '2025-04-08', '2025-04-08', 'D'),
(14, 20, 10, '1', 'Dine-In', '190.00', '2025-04-08', '2025-04-08', 'P'),
(15, 21, 26, '1', 'Takeaway', '20.00', '2025-04-08', '2025-04-08', 'D'),
(16, 17, 22, '1', 'Dine-in', '35.00', '2025-04-17', '2025-04-17', 'C'),
(17, 18, 23, '1', 'Takeaway', '180.00', '2025-04-18', '2025-04-19', 'D'),
(18, 19, 24, '1', 'Dine-in', '200.00', '2025-04-19', '2025-04-19', 'P'),
(19, 20, 25, '2', 'Takeaway', '30.00', '2025-04-20', '2025-04-21', 'D'),
(20, 21, 26, '1', 'Dine-in', '20.00', '2025-04-21', '2025-04-21', 'D'),
(21, 22, 2, '1', 'Takeaway', '80.00', '2025-04-22', '2025-04-22', 'D'),
(22, 23, 3, '1', 'Takeaway', '120.00', '2025-04-23', '2025-04-23', 'P'),
(23, 24, 5, '1', 'Dine-in', '160.00', '2025-04-24', '2025-04-25', 'C'),
(24, 2, 6, '1', 'Takeaway', '90.00', '2025-04-25', '2025-04-25', 'D'),
(25, 3, 10, '1', 'Dine-in', '190.00', '2025-04-26', '2025-04-26', 'D'),
(26, 4, 11, '1', 'Takeaway', '150.00', '2025-04-27', '2025-04-28', 'D'),
(27, 5, 12, '1', 'Takeaway', '150.00', '2025-04-28', '2025-04-29', 'P'),
(28, 6, 17, '1', 'Dine-in', '140.00', '2025-04-29', '2025-04-30', 'D'),
(29, 7, 18, '1', 'Takeaway', '120.00', '2025-04-30', '2025-05-01', 'D'),
(30, 8, 19, '1', 'Dine-in', '180.00', '2025-05-01', '2025-05-01', 'D'),
(31, 9, 20, '2', 'Takeaway', '440.00', '2025-05-02', '2025-05-03', 'D'),
(32, 10, 21, '1', 'Dine-in', '120.00', '2025-05-03', '2025-05-04', 'P'),
(33, 11, 23, '1', 'Takeaway', '180.00', '2025-05-04', '2025-05-04', 'C'),
(34, 12, 24, '1', 'Takeaway', '200.00', '2025-05-05', '2025-05-05', 'P'),
(35, 13, 25, '2', 'Dine-in', '30.00', '2025-05-06', '2025-05-07', 'D'),
(36, 14, 26, '1', 'Takeaway', '20.00', '2025-05-07', '2025-05-07', 'D'),
(37, 15, 9, '1', 'Takeaway', '80.00', '2025-05-08', '2025-05-08', 'D'),
(38, 16, 2, '1', 'Dine-in', '80.00', '2025-05-09', '2025-05-09', 'D'),
(39, 17, 7, '1', 'Takeaway', '90.00', '2025-05-10', '2025-05-10', 'P'),
(40, 18, 16, '2', 'Dine-in', '80.00', '2025-05-11', '2025-05-11', 'C'),
(41, 19, 17, '1', 'Takeaway', '140.00', '2025-05-12', '2025-05-13', 'D'),
(42, 20, 19, '1', 'Dine-in', '180.00', '2025-05-13', '2025-05-14', 'D'),
(43, 21, 20, '2', 'Takeaway', '440.00', '2025-05-14', '2025-05-14', 'D'),
(44, 22, 21, '1', 'Dine-in', '120.00', '2025-05-15', '2025-05-15', 'P'),
(45, 23, 22, '1', 'Takeaway', '35.00', '2025-05-16', '2025-05-17', 'D'),
(46, 24, 3, '1', 'Dine-in', '120.00', '2025-05-17', '2025-05-18', 'D'),
(47, 2, 6, '1', 'Takeaway', '90.00', '2025-05-18', '2025-05-18', 'P'),
(48, 3, 25, '2', 'Dine-in', '30.00', '2025-05-19', '2025-05-19', 'D'),
(49, 4, 26, '1', 'Takeaway', '20.00', '2025-05-19', '2025-05-19', 'D'),
(50, 5, 2, '1', 'Dine-in', '80.00', '2025-05-20', '2025-05-20', 'P');

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
(2, '23mmci48', 'mca.23mmci48@silicon.ac.in'),
(3, '23mmci76', 'mca.23mmci76@silicon.ac.in'),
(4, '23mmci87', 'mca.23mmci87@silicon.ac.in'),
(5, '23mmci01', 'mca.23mmci01@silicon.ac.in'),
(6, '23mmci02', 'mca.23mmci02@silicon.ac.in'),
(7, '23mmci03', 'mca.23mmci03@silicon.ac.in'),
(8, '23mmci04', 'mca.23mmci04@silicon.ac.in'),
(9, '23mmci05', 'mca.23mmci05@silicon.ac.in'),
(10, '23mmci06', 'mca.23mmci06@silicon.ac.in'),
(11, '23mmci07', 'mca.23mmci07@silicon.ac.in'),
(12, '23mmci08', 'mca.23mmci08@silicon.ac.in'),
(13, '23mmci09', 'mca.23mmci09@silicon.ac.in'),
(14, '23mmci10', 'mca.23mmci10@silicon.ac.in'),
(15, '23mmci11', 'mca.23mmci11@silicon.ac.in'),
(16, '23mmci12', 'mca.23mmci12@silicon.ac.in'),
(17, '23mmci13', 'mca.23mmci13@silicon.ac.in'),
(18, '23mmci14', 'mca.23mmci14@silicon.ac.in'),
(19, '23mmci15', 'mca.23mmci15@silicon.ac.in'),
(20, '23mmci16', 'mca.23mmci16@silicon.ac.in'),
(21, '23mmci17', 'mca.23mmci17@silicon.ac.in'),
(22, '23mmci18', 'mca.23mmci18@silicon.ac.in'),
(23, '23mmci19', 'mca.23mmci19@silicon.ac.in'),
(24, '23mmci20', 'mca.23mmci20@silicon.ac.in');

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
  `isActive` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `sic`, `seID`, `name`, `dob`, `password`, `isActive`) VALUES
(2, '23mmci48', 2, 'Soumendra', '2000-08-20', '12345', '1'),
(3, '23mmci76', 3, 'Priti', '2001-02-17', '2000', '0'),
(4, '23mmci87', 4, 'Himansu', '2001-06-20', '1478', '1'),
(5, '23mmci01', 5, 'Raj', '2002-01-15', '1234', '1'),
(6, '23mmci02', 6, 'Suman', '2000-11-12', '1234', '1'),
(7, '23mmci03', 7, 'Ravi', '2003-05-30', 'qwert', '1'),
(8, '23mmci04', 8, 'Rina', '2002-03-18', 'pass123', '1'),
(9, '23mmci05', 9, 'Nikita', '2001-10-22', 'abcd123', '0'),
(10, '23mmci06', 10, 'Kishore', '2001-07-08', 'hello123', '1'),
(11, '23mmci07', 11, 'Arjun', '2002-12-25', 'mypass', '0'),
(12, '23mmci08', 12, 'Priya', '2000-04-14', 'password', '1'),
(13, '23mmci09', 13, 'Sanjay', '2003-09-10', '123password', '1'),
(14, '23mmci10', 14, 'Meena', '2001-01-03', 'securepass', '0'),
(15, '23mmci11', 15, 'Sunita', '2002-06-11', 'mypassword', '1'),
(16, '23mmci12', 16, 'Abhinav', '2000-12-19', 'password123', '1'),
(17, '23mmci13', 17, 'Kavita', '2003-04-05', 'admin123', '1'),
(18, '23mmci14', 18, 'Dev', '2002-08-21', 'devpassword', '0'),
(19, '23mmci15', 19, 'Shivani', '2001-03-28', 'shivanipass', '1'),
(20, '23mmci16', 20, 'Vikas', '2002-02-16', 'vikas123', '1'),
(21, '23mmci17', 21, 'Amit', '2001-11-10', 'amit123', '1'),
(22, '23mmci18', 22, 'Sreeja', '2000-09-06', 'sreeja01', '1'),
(23, '23mmci19', 23, 'Tanu', '2003-12-12', 'tanu123', '1'),
(24, '23mmci20', 24, 'Manoj', '2002-04-07', 'manojpass', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `counter_category`
--
ALTER TABLE `counter_category`
  ADD PRIMARY KEY (`counterCategoryID`),
  ADD KEY `fk_counter_id` (`counterID`),
  ADD KEY `fk_fc_id` (`foodCategoryID`);

--
-- Indexes for table `counter_table`
--
ALTER TABLE `counter_table`
  ADD PRIMARY KEY (`counterID`);

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
-- AUTO_INCREMENT for table `counter_category`
--
ALTER TABLE `counter_category`
  MODIFY `counterCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `counter_table`
--
ALTER TABLE `counter_table`
  MODIFY `counterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `foodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `foodCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sic_email`
--
ALTER TABLE `sic_email`
  MODIFY `seID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `counter_category`
--
ALTER TABLE `counter_category`
  ADD CONSTRAINT `fk_counter_id` FOREIGN KEY (`counterID`) REFERENCES `counter_table` (`counterID`) ON DELETE SET NULL,
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
