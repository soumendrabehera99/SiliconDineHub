-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 07:19 PM
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
(1, '1', 23, 19, '5', 'Takeaway', '235.13', '2024-04-13', '2024-04-15', 'cancel'),
(2, '10', 22, 10, '1', 'Dine-In', '232.03', '2024-08-22', '2024-08-24', 'ready'),
(3, '100', 3, 20, '5', 'Takeaway', '71.51', '2025-04-11', '2025-04-13', 'cancel'),
(4, '11', 6, 20, '1', 'Takeaway', '145.9', '2024-10-06', '2024-10-08', 'pending'),
(5, '12', 4, 3, '5', 'Dine-In', '199.41', '2024-07-11', '2024-07-11', 'ready'),
(6, '13', 6, 23, '3', 'Takeaway', '203.21', '2024-09-02', '2024-09-02', 'pending'),
(7, '14', 7, 23, '4', 'Takeaway', '67.17', '2024-09-14', '2024-09-14', 'pending'),
(8, '15', 10, 5, '3', 'Takeaway', '60.13', '2024-08-07', '2024-08-08', 'delivered'),
(9, '16', 16, 12, '4', 'Dine-In', '154.88', '2025-01-24', '2025-01-25', 'pending'),
(10, '17', 22, 9, '3', 'Dine-In', '195.59', '2024-05-22', '2024-05-22', 'ready'),
(11, '18', 5, 12, '3', 'Dine-In', '163.71', '2024-03-24', '2024-03-27', 'delivered'),
(12, '19', 9, 21, '4', 'Takeaway', '207.19', '2025-02-20', '2025-02-21', 'delivered'),
(13, '2', 24, 23, '4', 'Dine-In', '56.03', '2025-03-21', '2025-03-21', 'delivered'),
(14, '20', 22, 5, '5', 'Takeaway', '173.51', '2024-07-06', '2024-07-07', 'cancel'),
(15, '21', 9, 19, '2', 'Takeaway', '240.07', '2024-02-06', '2024-02-08', 'ready'),
(16, '22', 4, 22, '5', 'Takeaway', '175.36', '2024-10-04', '2024-10-07', 'delivered'),
(17, '23', 4, 16, '4', 'Dine-In', '230.23', '2024-01-16', '2024-01-19', 'delivered'),
(18, '24', 2, 26, '3', 'Dine-In', '241.12', '2024-10-11', '2024-10-14', 'delivered'),
(19, '25', 14, 10, '3', 'Takeaway', '156.63', '2025-02-07', '2025-02-07', 'ready'),
(20, '26', 4, 18, '1', 'Dine-In', '140.0', '2025-04-02', '2025-04-02', 'delivered'),
(21, '27', 9, 5, '1', 'Dine-In', '89.99', '2025-03-09', '2025-03-11', 'delivered'),
(22, '28', 16, 17, '3', 'Takeaway', '42.11', '2024-11-05', '2024-11-07', 'delivered'),
(23, '29', 22, 17, '5', 'Takeaway', '237.65', '2024-09-27', '2024-09-29', 'delivered'),
(24, '3', 7, 18, '5', 'Dine-In', '78.4', '2024-12-29', '2024-12-30', 'pending'),
(25, '30', 5, 16, '3', 'Dine-In', '109.54', '2024-03-28', '2024-03-30', 'delivered'),
(26, '31', 24, 24, '5', 'Takeaway', '183.26', '2024-01-16', '2024-01-17', 'ready'),
(27, '32', 10, 12, '3', 'Takeaway', '98.49', '2025-02-13', '2025-02-13', 'pending'),
(28, '33', 12, 10, '3', 'Dine-In', '237.87', '2024-07-04', '2024-07-06', 'delivered'),
(29, '34', 10, 2, '3', 'Dine-In', '150.99', '2025-01-11', '2025-01-14', 'cancel'),
(30, '35', 17, 3, '2', 'Takeaway', '232.83', '2025-03-16', '2025-03-16', 'pending'),
(31, '36', 24, 25, '4', 'Takeaway', '118.49', '2024-03-16', '2024-03-17', 'delivered'),
(32, '37', 11, 11, '4', 'Takeaway', '62.01', '2024-06-14', '2024-06-16', 'cancel'),
(33, '38', 20, 11, '2', 'Dine-In', '245.25', '2025-01-16', '2025-01-18', 'cancel'),
(34, '39', 23, 17, '5', 'Dine-In', '170.47', '2024-09-04', '2024-09-04', 'ready'),
(35, '4', 11, 5, '5', 'Dine-In', '133.51', '2024-09-03', '2024-09-03', 'ready'),
(36, '40', 5, 2, '1', 'Takeaway', '220.71', '2024-09-14', '2024-09-17', 'delivered'),
(37, '41', 21, 25, '3', 'Takeaway', '51.9', '2024-11-10', '2024-11-10', 'delivered'),
(38, '42', 22, 17, '3', 'Takeaway', '178.67', '2024-10-08', '2024-10-09', 'ready'),
(39, '43', 24, 12, '2', 'Takeaway', '176.49', '2025-02-27', '2025-03-01', 'ready'),
(40, '44', 5, 16, '2', 'Dine-In', '87.6', '2025-02-04', '2025-02-06', 'delivered'),
(41, '45', 21, 7, '5', 'Dine-In', '147.38', '2024-10-01', '2024-10-02', 'delivered'),
(42, '46', 14, 17, '2', 'Takeaway', '128.74', '2024-03-14', '2024-03-16', 'delivered'),
(43, '47', 19, 16, '3', 'Dine-In', '58.54', '2024-08-27', '2024-08-29', 'cancel'),
(44, '48', 15, 22, '4', 'Takeaway', '184.27', '2024-08-29', '2024-08-31', 'delivered'),
(45, '49', 7, 24, '1', 'Dine-In', '84.85', '2024-09-19', '2024-09-21', 'ready'),
(46, '5', 21, 17, '3', 'Dine-In', '223.45', '2024-07-25', '2024-07-27', 'ready'),
(47, '50', 17, 3, '2', 'Takeaway', '161.37', '2024-03-14', '2024-03-15', 'cancel'),
(48, '51', 15, 21, '3', 'Takeaway', '83.7', '2024-11-27', '2024-11-27', 'pending'),
(49, '52', 18, 21, '2', 'Takeaway', '104.02', '2024-12-14', '2024-12-17', 'pending'),
(50, '53', 14, 22, '1', 'Takeaway', '180.66', '2024-06-28', '2024-06-30', 'ready'),
(51, '54', 20, 20, '5', 'Dine-In', '55.02', '2024-09-11', '2024-09-12', 'delivered'),
(52, '55', 16, 3, '3', 'Takeaway', '209.74', '2024-04-04', '2024-04-05', 'pending'),
(53, '56', 22, 19, '4', 'Dine-In', '41.38', '2025-03-23', '2025-03-24', 'cancel'),
(54, '57', 23, 25, '1', 'Dine-In', '223.38', '2024-01-23', '2024-01-26', 'cancel'),
(55, '58', 19, 11, '1', 'Takeaway', '218.98', '2024-10-20', '2024-10-22', 'delivered'),
(56, '59', 5, 24, '5', 'Takeaway', '126.31', '2024-10-29', '2024-10-31', 'cancel'),
(57, '6', 23, 26, '3', 'Takeaway', '182.72', '2025-04-02', '2025-04-03', 'delivered'),
(58, '60', 21, 6, '2', 'Takeaway', '150.52', '2024-09-14', '2024-09-16', 'ready'),
(59, '61', 8, 17, '4', 'Dine-In', '127.05', '2024-10-05', '2024-10-05', 'delivered'),
(60, '62', 13, 24, '3', 'Dine-In', '41.1', '2024-10-06', '2024-10-07', 'cancel'),
(61, '63', 5, 16, '1', 'Takeaway', '59.88', '2025-01-02', '2025-01-05', 'pending'),
(62, '64', 8, 3, '5', 'Takeaway', '167.51', '2024-07-07', '2024-07-09', 'cancel'),
(63, '65', 17, 7, '1', 'Takeaway', '134.85', '2024-06-03', '2024-06-05', 'cancel'),
(64, '66', 6, 2, '3', 'Dine-In', '174.04', '2025-03-05', '2025-03-06', 'delivered'),
(65, '67', 21, 7, '2', 'Dine-In', '239.69', '2025-02-13', '2025-02-15', 'cancel'),
(66, '68', 20, 17, '3', 'Dine-In', '185.37', '2024-08-14', '2024-08-16', 'delivered'),
(67, '69', 19, 22, '1', 'Dine-In', '217.36', '2025-01-22', '2025-01-25', 'pending'),
(68, '7', 15, 5, '3', 'Takeaway', '43.46', '2025-05-06', '2025-05-08', 'delivered'),
(69, '70', 19, 2, '5', 'Takeaway', '132.86', '2024-12-21', '2024-12-24', 'delivered'),
(70, '71', 7, 22, '1', 'Dine-In', '100.86', '2024-02-08', '2024-02-10', 'delivered'),
(71, '72', 7, 23, '4', 'Takeaway', '168.6', '2025-04-03', '2025-04-04', 'delivered'),
(72, '73', 16, 17, '2', 'Takeaway', '150.55', '2024-10-06', '2024-10-07', 'delivered'),
(73, '74', 5, 10, '5', 'Takeaway', '103.96', '2025-01-19', '2025-01-21', 'pending'),
(74, '75', 2, 12, '3', 'Dine-In', '239.64', '2024-03-05', '2024-03-07', 'pending'),
(75, '76', 10, 25, '3', 'Takeaway', '127.96', '2024-01-31', '2024-02-02', 'delivered'),
(76, '77', 5, 26, '1', 'Takeaway', '249.87', '2024-09-01', '2024-09-01', 'ready'),
(77, '78', 12, 11, '5', 'Takeaway', '128.65', '2024-07-18', '2024-07-18', 'delivered'),
(78, '79', 16, 12, '1', 'Dine-In', '158.79', '2024-01-16', '2024-01-16', 'delivered'),
(79, '8', 3, 11, '1', 'Takeaway', '92.26', '2024-10-01', '2024-10-04', 'pending'),
(80, '80', 22, 19, '3', 'Takeaway', '198.44', '2024-08-17', '2024-08-20', 'ready'),
(81, '81', 18, 19, '4', 'Dine-In', '215.86', '2024-11-14', '2024-11-16', 'delivered'),
(82, '82', 17, 23, '5', 'Takeaway', '199.25', '2024-03-21', '2024-03-23', 'pending'),
(83, '83', 16, 26, '4', 'Dine-In', '40.24', '2024-01-28', '2024-01-30', 'ready'),
(84, '84', 19, 12, '3', 'Dine-In', '217.5', '2025-03-11', '2025-03-14', 'ready'),
(85, '85', 14, 18, '2', 'Dine-In', '126.03', '2024-03-05', '2024-03-08', 'ready'),
(86, '86', 22, 7, '3', 'Dine-In', '118.78', '2024-08-17', '2024-08-18', 'cancel'),
(87, '87', 7, 16, '4', 'Dine-In', '141.88', '2025-03-09', '2025-03-11', 'delivered'),
(88, '88', 6, 21, '5', 'Dine-In', '151.72', '2025-05-07', '2025-05-09', 'cancel'),
(89, '89', 6, 2, '5', 'Dine-In', '158.19', '2025-04-08', '2025-04-10', 'delivered'),
(90, '9', 21, 2, '3', 'Dine-In', '226.19', '2025-03-29', '2025-03-31', 'cancel'),
(91, '90', 5, 9, '2', 'Dine-In', '166.41', '2024-02-03', '2024-02-03', 'delivered'),
(92, '91', 20, 3, '5', 'Takeaway', '210.0', '2025-01-25', '2025-01-26', 'cancel'),
(93, '92', 5, 18, '4', 'Dine-In', '123.95', '2024-04-19', '2024-04-20', 'ready'),
(94, '93', 8, 2, '5', 'Dine-In', '50.42', '2024-08-23', '2024-08-24', 'ready'),
(95, '94', 9, 3, '3', 'Takeaway', '171.44', '2024-05-16', '2024-05-19', 'delivered'),
(96, '95', 12, 17, '1', 'Dine-In', '244.48', '2024-01-08', '2024-01-11', 'delivered'),
(97, '96', 21, 9, '3', 'Dine-In', '71.89', '2024-09-10', '2024-09-11', 'pending'),
(98, '97', 23, 11, '5', 'Dine-In', '60.7', '2024-12-11', '2024-12-13', 'cancel'),
(99, '98', 17, 2, '3', 'Dine-In', '172.21', '2024-11-23', '2024-11-25', 'ready'),
(100, '99', 22, 21, '1', 'Takeaway', '175.5', '2025-04-16', '2025-04-17', 'pending'),
(131, '100', 1, 19, '2', 'Dine-In', '120', '2025-04-01', '2025-04-02', 'pending'),
(132, '101', 1, 10, '1', 'Takeaway', '45', '2025-04-03', '2025-04-04', 'delivered'),
(133, '102', 1, 20, '3', 'Dine-In', '150', '2025-04-05', '2025-04-06', 'ready'),
(134, '103', 1, 23, '4', 'Takeaway', '100', '2025-04-06', '2025-04-07', 'cancel'),
(135, '104', 1, 23, '2', 'Dine-In', '130', '2025-04-08', '2025-04-08', 'delivered'),
(136, '105', 1, 5, '5', 'Takeaway', '185', '2025-04-08', '2025-04-09', 'pending'),
(137, '106', 1, 12, '1', 'Takeaway', '55', '2025-04-09', '2025-04-09', 'ready'),
(138, '107', 1, 9, '2', 'Dine-In', '98', '2025-04-09', '2025-04-09', 'delivered'),
(139, '108', 1, 12, '3', 'Takeaway', '105', '2025-04-07', '2025-04-08', 'cancel'),
(140, '109', 1, 16, '1', 'Dine-In', '79', '2025-04-09', '2025-04-09', 'ready');

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
(1, '23mmci37', 1, 'Anil Sahu', '2002-10-10', '1234', '1'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

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
