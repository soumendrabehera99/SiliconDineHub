-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 11:19 AM
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
('admin1@gmail.com', 'Admin1', '1234'),
('admin2@gmail.com', 'Admin2', '456'),
('admin3@gmail.com', 'Admin3', '789'),
('admin@gmail.com', 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `message`, `from_date`, `to_date`) VALUES
(1, 'New Cafeteria Timings', 'The cafeteria will now open from 10 AM to 7 PM every day. Please plan accordingly.', '2025-04-28', '2025-05-28'),
(2, 'New Menu Items Available', 'We are excited to introduce new items in our menu, including healthy options! Check them out in the cafeteria today!', '2025-04-28', '2025-05-05'),
(3, 'Holiday Notice', 'The cafeteria will remain closed on May 1st due to a public holiday. Plan your meals accordingly.', '2025-04-28', '2025-05-01'),
(4, 'Cafeteria Under Maintenance', 'The cafeteria will be under maintenance from 5 PM to 7 PM on April 30th. Sorry for the inconvenience.', '2025-04-30', '2025-04-30');

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
(3, NULL, NULL),
(21, 1, 1),
(22, 1, 2),
(23, 1, 3),
(24, 1, 4),
(25, 1, 5),
(26, 1, 6),
(27, 1, 7),
(28, 1, 8),
(29, 1, 9),
(30, 1, 10),
(31, 1, 11);

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
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `facultyID` int(11) NOT NULL,
  `sic` varchar(255) NOT NULL,
  `seID` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(128) NOT NULL,
  `isActive` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facultyID`, `sic`, `seID`, `name`, `dob`, `password`, `isActive`) VALUES
(1, 'FCS22210', 28, 'Surajit Das', '1993-01-01', '1234', '1');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `feedback_type` varchar(50) NOT NULL,
  `rating` int(11) NOT NULL,
  `feedback_text` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `studentID`, `feedback_type`, `rating`, `feedback_text`, `submitted_at`) VALUES
(1, 1, 'food', 5, 'The food was delicious and fresh. Loved it!', '2025-04-28 18:05:21'),
(2, 2, 'staff', 4, 'Staff was very helpful and friendly.', '2025-04-28 18:05:21'),
(3, 3, 'cafeteria', 3, 'Cafeteria ambiance could be better.', '2025-04-28 18:05:21'),
(4, 4, 'food', 5, 'Really enjoyed the variety of meals.', '2025-04-28 18:05:21'),
(5, 5, 'staff', 2, 'Staff seemed a bit unorganized today.', '2025-04-28 18:05:21'),
(6, 6, 'cafeteria', 4, 'The cafeteria is clean and spacious.', '2025-04-28 18:05:21'),
(7, 7, 'food', 5, 'Food quality is consistently good!', '2025-04-28 18:05:21'),
(8, 8, 'staff', 3, 'Staff response time was slow.', '2025-04-28 18:05:21'),
(9, 9, 'cafeteria', 4, 'Love the open seating in cafeteria.', '2025-04-28 18:05:21'),
(10, 10, 'food', 5, 'Best biryani I have ever had at college!', '2025-04-28 18:05:21'),
(11, 11, 'staff', 2, 'Staff needs to improve coordination.', '2025-04-28 18:05:21'),
(12, 12, 'cafeteria', 3, 'Cafeteria could use some background music.', '2025-04-28 18:05:21'),
(13, 13, 'food', 5, 'Healthy food options are amazing.', '2025-04-28 18:05:21'),
(14, 14, 'staff', 4, 'Staff members are polite and helpful.', '2025-04-28 18:05:21'),
(15, 15, 'cafeteria', 3, 'Cafeteria environment is good but a bit noisy.', '2025-04-28 18:05:21');

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
(26, 4, 'Sweet Curd', 'food_67ee8c8184e211.48761397.jpeg', 'A creamy and luscious Bengali dessert made by fermenting thickened milk with caramelized sugar, creating a naturally sweet, rich, and velvety-textured yogurt.', 20.00, 'VEG', '1'),
(27, 2, 'Hakka Noodles', 'food_6809c51b521ca0.72602568.jpeg', 'A popular espresso-based coffee with steamed milk and a frothy top, offering a rich and creamy flavor.', 100.00, 'VEG', '1'),
(28, 3, 'Lemon Rice', 'food_6809c57a12ba03.22304359.jpeg', 'Zesty South Indian rice dish flavored with lemon juice, curry leaves, and mustard seeds.', 70.00, 'VEG', '1'),
(29, 4, 'Rasgulla', 'food_6809c5c29dda84.97121255.jpeg', 'Soft and spongy balls made from chenna and soaked in sugar syrup, a classic Bengali sweet.', 20.00, 'VEG', '1'),
(30, 9, 'Manchow Soup', 'food_6809c62111d8e0.67990855.jpeg', 'Spicy Indo-Chinese soup loaded with vegetables and crispy noodles.', 50.00, 'VEG', '1');

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
  `id` int(11) NOT NULL,
  `orderID` varchar(11) NOT NULL,
  `studentID` int(11) DEFAULT NULL,
  `foodID` int(11) DEFAULT NULL,
  `quantity` varchar(255) NOT NULL,
  `orderType` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `orderID`, `studentID`, `foodID`, `quantity`, `orderType`, `price`, `createdAt`, `updatedAt`, `status`) VALUES
(1, '23mmci19', 23, 19, '5', 'Takeaway', '235', '2025-03-13', '2025-03-15', 'cancel'),
(2, '23mmci18', 22, 10, '1', 'Dine-In', '232', '2025-04-22', '2025-04-24', 'ready'),
(3, '23mmci76', 3, 20, '5', 'Takeaway', '72', '2025-04-11', '2025-04-13', 'delivered'),
(4, '23mmci02', 6, 20, '1', 'Takeaway', '146', '2025-03-06', '2025-03-08', 'pending'),
(5, '23mmci87', 4, 3, '5', 'Dine-In', '199', '2025-04-11', '2025-04-11', 'ready'),
(6, '23mmci02', 6, 23, '3', 'Takeaway', '203', '2025-02-02', '2025-02-02', 'pending'),
(7, '23mmci03', 7, 23, '4', 'Takeaway', '67', '2025-03-14', '2025-03-14', 'pending'),
(8, '23mmci06', 10, 5, '3', 'Takeaway', '60', '2025-04-07', '2025-04-08', 'delivered'),
(9, '23mmci12', 16, 12, '4', 'Dine-In', '155', '2025-01-24', '2025-01-25', 'pending'),
(10, '23mmci18', 22, 9, '3', 'Dine-In', '196', '2025-03-22', '2025-03-22', 'ready'),
(11, '23mmci01', 5, 12, '3', 'Dine-In', '164', '2025-04-24', '2025-04-27', 'delivered'),
(12, '23mmci05', 9, 21, '4', 'Takeaway', '207', '2025-02-20', '2025-02-21', 'delivered'),
(13, '23mmci20', 24, 23, '4', 'Dine-In', '56', '2025-03-21', '2025-03-21', 'delivered'),
(14, '23mmci18', 22, 5, '5', 'Takeaway', '174', '2025-04-06', '2025-04-07', 'cancel'),
(15, '23mmci05', 9, 19, '2', 'Takeaway', '240', '2025-02-06', '2025-02-08', 'ready'),
(16, '23mmci87', 4, 22, '5', 'Takeaway', '175', '2025-03-04', '2025-03-07', 'delivered'),
(17, '23mmci87', 4, 16, '4', 'Dine-In', '230', '2025-04-16', '2025-04-19', 'delivered'),
(18, '23mmci48', 2, 26, '3', 'Dine-In', '241', '2025-02-11', '2025-02-14', 'delivered'),
(19, '23mmci10', 14, 10, '3', 'Takeaway', '157', '2025-02-07', '2025-02-07', 'ready'),
(20, '23mmci87', 4, 18, '1', 'Dine-In', '140', '2025-04-02', '2025-04-02', 'delivered'),
(21, '23mmci05', 9, 5, '1', 'Dine-In', '90', '2025-03-09', '2025-03-11', 'delivered'),
(22, '23mmci12', 16, 17, '3', 'Takeaway', '42', '2025-03-05', '2025-03-07', 'delivered'),
(23, '23mmci18', 22, 17, '5', 'Takeaway', '238', '2025-04-27', '2025-04-29', 'delivered'),
(24, '23mmci03', 7, 18, '5', 'Dine-In', '78', '0000-00-00', '0000-00-00', 'pending'),
(25, '23mmci01', 5, 16, '3', 'Dine-In', '110', '2025-03-28', '2025-03-30', 'delivered'),
(26, '23mmci20', 24, 24, '5', 'Takeaway', '183', '2025-04-16', '2025-04-17', 'ready'),
(27, '23mmci06', 10, 12, '3', 'Takeaway', '98', '2025-02-13', '2025-02-13', 'pending'),
(28, '23mmci08', 12, 10, '3', 'Dine-In', '238', '2025-03-04', '2025-03-06', 'delivered'),
(29, '23mmci06', 10, 2, '3', 'Dine-In', '151', '2025-01-11', '2025-01-14', 'cancel'),
(30, '23mmci13', 17, 3, '2', 'Takeaway', '233', '2025-03-16', '2025-03-16', 'pending'),
(31, '23mmci20', 24, 25, '4', 'Takeaway', '118', '2025-03-16', '2025-03-17', 'delivered'),
(32, '23mmci07', 11, 11, '4', 'Takeaway', '62', '2025-04-14', '2025-04-16', 'cancel'),
(33, '23mmci16', 20, 11, '2', 'Dine-In', '245', '2025-01-16', '2025-01-18', 'cancel'),
(34, '23mmci19', 23, 17, '5', 'Dine-In', '170', '2025-03-04', '2025-03-04', 'ready'),
(35, '23mmci07', 11, 5, '5', 'Dine-In', '134', '2025-04-03', '2025-04-03', 'ready'),
(36, '23mmci01', 5, 2, '1', 'Takeaway', '221', '2025-02-14', '2025-02-17', 'delivered'),
(37, '23mmci17', 21, 25, '3', 'Takeaway', '52', '2025-03-10', '2025-03-10', 'delivered'),
(38, '23mmci18', 22, 17, '3', 'Takeaway', '179', '2025-04-08', '2025-04-09', 'ready'),
(39, '23mmci20', 24, 12, '2', 'Takeaway', '176', '2025-02-27', '2025-03-01', 'ready'),
(40, '23mmci01', 5, 16, '2', 'Dine-In', '88', '2025-02-04', '2025-02-06', 'delivered'),
(41, '23mmci17', 21, 7, '5', 'Dine-In', '147', '2025-04-01', '2025-04-02', 'delivered'),
(42, '23mmci10', 14, 17, '2', 'Takeaway', '129', '2025-02-14', '2025-02-16', 'delivered'),
(43, '23mmci15', 19, 16, '3', 'Dine-In', '59', '2025-03-27', '2025-03-29', 'cancel'),
(44, '23mmci11', 15, 22, '4', 'Takeaway', '184', '2025-04-29', '0000-00-00', 'delivered'),
(45, '23mmci03', 7, 24, '1', 'Dine-In', '85', '2025-02-19', '2025-02-21', 'ready'),
(46, '23mmci17', 21, 17, '3', 'Dine-In', '223', '2025-03-25', '2025-03-27', 'ready'),
(47, '23mmci13', 17, 3, '2', 'Takeaway', '161', '2025-04-14', '2025-04-15', 'cancel'),
(48, '23mmci11', 15, 21, '3', 'Takeaway', '84', '2025-02-27', '2025-02-27', 'pending'),
(49, '23mmci14', 18, 21, '2', 'Takeaway', '104', '2025-03-14', '2025-03-17', 'pending'),
(50, '23mmci10', 14, 22, '1', 'Takeaway', '181', '2025-04-28', '2025-04-30', 'ready'),
(51, '23mmci16', 20, 20, '5', 'Dine-In', '55', '2025-02-11', '2025-02-12', 'delivered'),
(52, '23mmci12', 16, 3, '3', 'Takeaway', '210', '2025-03-04', '2025-03-05', 'pending'),
(53, '23mmci18', 22, 19, '4', 'Dine-In', '41', '2025-03-23', '2025-03-24', 'cancel'),
(54, '23mmci19', 23, 25, '1', 'Dine-In', '223', '2025-02-23', '2025-02-26', 'cancel'),
(55, '23mmci15', 19, 11, '1', 'Takeaway', '219', '2025-03-20', '2025-03-22', 'delivered'),
(56, '23mmci01', 5, 24, '5', 'Takeaway', '126', '2025-04-29', '0000-00-00', 'cancel'),
(57, '23mmci19', 23, 26, '3', 'Takeaway', '183', '2025-04-02', '2025-04-03', 'delivered'),
(58, '23mmci17', 21, 6, '2', 'Takeaway', '151', '2025-03-14', '2025-03-16', 'ready'),
(59, '23mmci04', 8, 17, '4', 'Dine-In', '127', '2025-04-05', '2025-04-05', 'delivered'),
(60, '23mmci09', 13, 24, '3', 'Dine-In', '41', '2025-02-06', '2025-02-07', 'cancel'),
(61, '23mmci01', 5, 16, '1', 'Takeaway', '60', '2025-01-02', '2025-01-05', 'pending'),
(62, '23mmci04', 8, 3, '5', 'Takeaway', '168', '2025-04-07', '2025-04-09', 'cancel'),
(63, '23mmci13', 17, 7, '1', 'Takeaway', '135', '2025-02-03', '2025-02-05', 'cancel'),
(64, '23mmci02', 6, 2, '3', 'Dine-In', '174', '2025-03-05', '2025-03-06', 'delivered'),
(65, '23mmci17', 21, 7, '2', 'Dine-In', '240', '2025-02-13', '2025-02-15', 'cancel'),
(66, '23mmci16', 20, 17, '3', 'Dine-In', '185', '2025-02-14', '2025-02-16', 'delivered'),
(67, '23mmci15', 19, 22, '1', 'Dine-In', '217', '2025-01-22', '2025-01-25', 'pending'),
(68, '23mmci11', 15, 5, '3', 'Takeaway', '43', '2025-05-06', '2025-05-08', 'delivered'),
(69, '23mmci15', 19, 2, '5', 'Takeaway', '133', '2025-02-21', '2025-02-24', 'delivered'),
(70, '23mmci03', 7, 22, '1', 'Dine-In', '101', '2025-03-08', '2025-03-10', 'delivered'),
(71, '23mmci03', 7, 23, '4', 'Takeaway', '169', '2025-04-03', '2025-04-04', 'delivered'),
(72, '23mmci12', 16, 17, '2', 'Takeaway', '151', '2025-02-06', '2025-02-07', 'delivered'),
(73, '23mmci01', 5, 10, '5', 'Takeaway', '104', '2025-01-19', '2025-01-21', 'pending'),
(74, '23mmci48', 2, 12, '3', 'Dine-In', '240', '2025-04-05', '2025-04-07', 'pending'),
(75, '23mmci06', 10, 25, '3', 'Takeaway', '128', '0000-00-00', '2025-02-02', 'delivered'),
(76, '23mmci01', 5, 26, '1', 'Takeaway', '250', '2025-03-01', '2025-03-01', 'ready'),
(77, '23mmci08', 12, 11, '5', 'Takeaway', '129', '2025-04-18', '2025-04-18', 'delivered'),
(78, '23mmci12', 16, 12, '1', 'Dine-In', '159', '2025-02-16', '2025-02-16', 'delivered'),
(79, '23mmci76', 3, 11, '1', 'Takeaway', '92', '2025-03-01', '2025-03-04', 'pending'),
(80, '23mmci18', 22, 19, '3', 'Takeaway', '198', '2025-04-17', '2025-04-20', 'ready'),
(81, '23mmci14', 18, 19, '4', 'Dine-In', '216', '2025-02-14', '2025-02-16', 'delivered'),
(82, '23mmci13', 17, 23, '5', 'Takeaway', '199', '2025-03-21', '2025-03-23', 'pending'),
(83, '23mmci12', 16, 26, '4', 'Dine-In', '40', '2025-04-28', '2025-04-30', 'ready'),
(84, '23mmci15', 19, 12, '3', 'Dine-In', '218', '2025-03-11', '2025-03-14', 'ready'),
(85, '23mmci10', 14, 18, '2', 'Dine-In', '126', '2025-03-05', '2025-03-08', 'ready'),
(86, '23mmci18', 22, 7, '3', 'Dine-In', '119', '2025-04-17', '2025-04-18', 'cancel'),
(87, '23mmci03', 7, 16, '4', 'Dine-In', '142', '2025-03-09', '2025-03-11', 'delivered'),
(88, '23mmci02', 6, 21, '5', 'Dine-In', '152', '2025-05-07', '2025-05-09', 'cancel'),
(89, '23mmci02', 6, 2, '5', 'Dine-In', '158', '2025-04-08', '2025-04-10', 'delivered'),
(90, '23mmci17', 21, 2, '3', 'Dine-In', '226', '2025-03-29', '2025-03-31', 'cancel'),
(91, '23mmci01', 5, 9, '2', 'Dine-In', '166', '2025-03-03', '2025-03-03', 'delivered'),
(92, '23mmci16', 20, 3, '5', 'Takeaway', '210', '2025-01-25', '2025-01-26', 'cancel'),
(93, '23mmci01', 5, 18, '4', 'Dine-In', '124', '2025-02-19', '2025-02-20', 'ready'),
(94, '23mmci04', 8, 2, '5', 'Dine-In', '50', '2025-03-23', '2025-03-24', 'ready'),
(95, '23mmci05', 9, 3, '3', 'Takeaway', '171', '2025-04-16', '2025-04-19', 'delivered'),
(96, '23mmci08', 12, 17, '1', 'Dine-In', '244', '2025-02-08', '2025-02-11', 'delivered'),
(97, '23mmci17', 21, 9, '3', 'Dine-In', '72', '2025-03-10', '2025-03-11', 'pending'),
(98, '23mmci19', 23, 11, '5', 'Dine-In', '61', '2025-04-11', '2025-04-13', 'cancel'),
(99, '23mmci13', 17, 2, '3', 'Dine-In', '172', '2025-02-23', '2025-02-25', 'ready'),
(100, '23mmci18', 22, 21, '1', 'Takeaway', '176', '2025-04-16', '2025-04-17', 'pending'),
(131, '23mmci37', 1, 19, '2', 'Dine-In', '120', '2025-04-01', '2025-04-02', 'ready'),
(132, '23mmci37', 1, 10, '1', 'Takeaway', '45', '2025-04-03', '2025-04-04', 'delivered'),
(133, '23mmci37', 1, 20, '3', 'Dine-In', '150', '2025-04-05', '2025-04-06', 'pending'),
(134, '23mmci37', 1, 23, '4', 'Takeaway', '100', '2025-04-06', '2025-04-07', 'cancel'),
(135, '23mmci37', 1, 23, '2', 'Dine-In', '130', '2025-04-08', '2025-04-08', 'delivered'),
(136, '23mmci37', 1, 5, '5', 'Takeaway', '185', '2025-04-08', '2025-04-09', 'pending'),
(137, '23mmci37', 1, 12, '1', 'Takeaway', '55', '2025-04-09', '2025-04-09', 'delivered'),
(138, '23mmci37', 1, 9, '2', 'Dine-In', '98', '2025-04-09', '2025-04-09', 'cancel'),
(139, '23mmci37', 1, 12, '3', 'Takeaway', '105', '2025-04-07', '2025-04-08', 'cancel'),
(140, '23mmci37', 1, 16, '1', 'Dine-In', '79', '2025-04-09', '2025-04-09', 'ready'),
(141, '23MMCI44', 25, 10, '1', 'Dine-In', '190', '2025-04-18', '2025-04-18', 'delivered'),
(142, '23MMCI44', 25, 11, '1', 'Dine-In', '150', '2025-04-18', '2025-04-18', 'delivered'),
(143, '23MMCI44', 25, 5, '1', 'Dine-In', '160', '2025-04-18', '2025-04-18', 'delivered'),
(144, '23MMCI44', 25, 11, '1', 'Dine-In', '150', '2025-04-18', '2025-04-18', 'delivered'),
(145, '23MMCI44', 25, 22, '1', 'Dine-In', '35', '2025-04-18', '2025-04-18', 'delivered'),
(146, '23MMCI44', 25, 20, '1', 'Dine-In', '220', '2025-04-18', '2025-04-18', 'pending'),
(147, '23mmci37', 1, 9, '2', 'Takeaway', '160', '2025-04-19', '2025-04-19', 'delivered'),
(148, '23mmci37', 1, 22, '2', 'Takeaway', '70', '2025-04-19', '2025-04-19', 'ready'),
(149, '23mmci37', 1, 12, '1', 'Takeaway', '150', '2025-04-19', '2025-04-19', 'pending'),
(150, '23mmci37', 1, 21, '1', 'Takeaway', '120', '2025-04-19', '2025-04-19', 'pending'),
(151, '23mmci48', 2, 2, '1', 'Takeaway', '80', '2025-04-20', '2025-04-20', 'delivered'),
(152, '23mmci48', 2, 6, '1', 'Takeaway', '90', '2025-04-20', '2025-04-20', 'delivered'),
(153, '23mmci48', 2, 16, '1', 'Takeaway', '40', '2025-04-20', '2025-04-20', 'delivered'),
(154, '23mmci19', 23, 3, '2', 'Dine-In', '240', '2025-04-20', '2025-04-20', 'ready'),
(155, '23mmci19', 23, 12, '1', 'Dine-In', '150', '2025-04-20', '2025-04-20', 'delivered'),
(156, '23mmci19', 23, 19, '1', 'Dine-In', '180', '2025-04-20', '2025-04-20', 'pending'),
(157, '23mmci19', 23, 25, '1', 'Dine-In', '15', '2025-04-20', '2025-04-20', 'ready'),
(158, '23mmci02', 6, 3, '1', 'Dine-In', '120', '2025-04-21', '2025-04-24', 'pending'),
(159, '23mmci02', 6, 19, '1', 'Dine-In', '180', '2025-04-21', '2025-04-24', 'pending'),
(160, '23mmci02', 6, 23, '1', 'Dine-In', '180', '2025-04-22', '2025-04-24', 'pending'),
(161, '23mmci02', 6, 7, '1', 'Takeaway', '90', '2025-04-22', '2025-04-24', 'pending'),
(162, '23mmci02', 6, 11, '1', 'Takeaway', '150', '2025-04-22', '2025-04-24', 'pending'),
(163, '23mmci02', 6, 18, '1', 'Takeaway', '120', '2025-04-23', '2025-04-24', 'pending'),
(164, '23mmci02', 6, 21, '1', 'Takeaway', '120', '2025-04-24', '2025-04-24', 'pending'),
(165, '23mmci04', 8, 11, '1', 'Dine-In', '150', '2025-04-24', '2025-04-24', 'pending'),
(166, '23mmci04', 8, 27, '1', 'Dine-In', '100', '2025-04-24', '2025-04-24', 'pending'),
(167, '23mmci04', 8, 29, '1', 'Dine-In', '20', '2025-04-24', '2025-04-24', 'pending'),
(168, '23mmci04', 8, 28, '1', 'Dine-In', '70', '2025-04-24', '2025-04-24', 'pending'),
(169, '23mmci04', 8, 30, '1', 'Dine-In', '50', '2025-04-24', '2025-04-24', 'pending'),
(170, '23mmci06', 10, 10, '1', 'Dine-In', '190', '2025-04-25', '2025-04-25', 'pending'),
(171, '23mmci06', 10, 16, '1', 'Dine-In', '40', '2025-04-25', '2025-04-25', 'pending'),
(172, '23mmci06', 10, 26, '2', 'Dine-In', '40', '2025-04-25', '2025-04-25', 'ready'),
(173, '23mmci06', 10, 25, '1', 'Dine-In', '15', '2025-04-25', '2025-04-25', 'pending');

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
(24, '23mmci20', 'mca.23mmci20@silicon.ac.in'),
(26, '23MMCI44', 'mca.23mmci44@silicon.ac.in'),
(27, '23MMCD02', 'mca.23mmcd02@silicon.ac.in'),
(28, 'FCS22210', 'surajit.das@silicon.ac.in'),
(29, 'FCS22202', 'das@silicon.ac.in'),
(30, '23MMCD03', 'mca.23mmcd03@silicon.ac.in'),
(31, '23MMCD04', 'mca.23mmci04@silicon.ac.in');

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
(1, '23mmci37', 1, 'Anil Sahu', '2002-10-10', '1234', '1'),
(2, '23mmci48', 2, 'Soumendra', '2000-08-20', '12345', '1'),
(3, '23mmci76', 3, 'Priti', '2001-02-17', '2000', '1'),
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
(24, '23mmci20', 24, 'Manoj', '2002-04-07', 'manojpass', '0'),
(25, '23MMCI44', 26, 'Subhendu Behera', '2008-01-06', 'subha@123', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`facultyID`),
  ADD KEY `seID` (`seID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentID` (`studentID`);

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
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `counter_category`
--
ALTER TABLE `counter_category`
  MODIFY `counterCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `counter_table`
--
ALTER TABLE `counter_table`
  MODIFY `counterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `foodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `foodCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `sic_email`
--
ALTER TABLE `sic_email`
  MODIFY `seID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`seID`) REFERENCES `sic_email` (`seID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE;

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
