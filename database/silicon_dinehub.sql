-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 11:33 AM
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
-- Table structure for table `cafeteria_status`
--

CREATE TABLE `cafeteria_status` (
  `id` int(11) NOT NULL,
  `is_open` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cafeteria_status`
--

INSERT INTO `cafeteria_status` (`id`, `is_open`) VALUES
(1, 1);

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
(1, 'FCS22202', 29, 'Soumendra', '1983-03-20', 'Soum@1234', '1'),
(2, 'FCS22210', 28, 'Surajit Das', '1996-04-20', 'Surajit@123', '1');

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
(1, 1, 'Food', 5, 'The food was absolutely delicious today. I really enjoyed the spicy biryani and the cold coffee. Everything was fresh, flavorful, and served hot. Great experience overall.', '2025-04-30 18:00:54'),
(2, 2, 'Staff', 4, 'The staff was very polite and efficient. They handled a large crowd smoothly and made sure everyone was served on time. Their friendly attitude made the cafeteria feel welcoming.', '2025-04-30 18:00:54'),
(3, 3, 'Cafeteria', 4, 'The cafeteria has improved a lot. The seating arrangement is now better, and it is a lot cleaner. The environment is much more comfortable for enjoying meals and hanging out.', '2025-04-30 18:00:54'),
(4, 4, 'Food', 5, 'Every dish I tried was tasty. The pasta was creamy and the salad fresh. I loved how everything was prepared with such attention to detail and served piping hot.', '2025-04-30 18:00:54'),
(5, 5, 'Staff', 5, 'The staff was extremely helpful today. They even helped me find a seat when it was crowded. It’s nice to see such thoughtful gestures from the cafeteria team.', '2025-04-30 18:00:54'),
(6, 6, 'Cafeteria', 4, 'I love the new decor in the cafeteria. It’s bright, welcoming, and makes the space feel much more lively. A bit more space for seating would make it even better.', '2025-04-30 18:00:54'),
(7, 7, 'Food', 5, 'The food was incredible! The flavors were balanced perfectly, and the presentation was top-notch. The dessert was a perfect way to end my meal. Highly recommend it to everyone!', '2025-04-30 18:00:54'),
(8, 8, 'Staff', 4, 'The staff was attentive and patient. They took the time to explain the menu and were quick to offer assistance when needed. It made the dining experience more enjoyable.', '2025-04-30 18:00:54'),
(9, 9, 'Cafeteria', 5, 'The cafeteria is spacious and clean. There’s always a good variety of food options, and the staff maintains a positive, friendly atmosphere. It’s a comfortable place to relax and eat.', '2025-04-30 18:00:54'),
(10, 10, 'Food', 4, 'The meal was great, especially the biryani. It was flavorful and filling. However, the portion could have been a bit larger. Overall, I was satisfied with the food and service.', '2025-04-30 18:00:54');

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
  `sic` varchar(15) DEFAULT NULL,
  `foodID` int(11) DEFAULT NULL,
  `quantity` varchar(255) NOT NULL,
  `orderType` varchar(255) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `orderID`, `sic`, `foodID`, `quantity`, `orderType`, `address`, `price`, `createdAt`, `updatedAt`, `status`) VALUES
(1, 'FCS22210', 'FCS22210', 11, '1', 'Dine-In', ' ', '150', '2025-05-03', '2025-05-03', 'ready'),
(2, 'FCS22210', 'FCS22210', 12, '1', 'Dine-In', ' ', '150', '2025-05-03', '2025-05-03', 'pending'),
(3, 'FCS22210', 'FCS22210', 10, '1', 'Delivery', 'cse building , 3rd floor , 432', '190', '2025-05-03', '2025-05-03', 'pending'),
(4, 'FCS22210', 'FCS22210', 11, '1', 'Delivery', 'cse building , 3rd floor , 432', '150', '2025-05-03', '2025-05-03', 'ready'),
(5, '23mmci48', '23mmci48', 11, '1', 'Dine-In', ' ', '150', '2025-05-03', '2025-05-03', 'pending'),
(6, '23mmci48', '23mmci48', 12, '1', 'Dine-In', ' ', '150', '2025-05-03', '2025-05-03', 'pending');

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
(25, '23MMCI44', 26, 'Subhendu Behera', '2008-01-06', 'subha@123', '1'),
(26, 'FCS22202', 29, 'Soumendra', '1999-03-10', 'Abcd@123', '1'),
(27, 'FCS22202', 29, 'Soumendra', '1983-03-09', 'Abcd@1234', '1');

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
-- Indexes for table `cafeteria_status`
--
ALTER TABLE `cafeteria_status`
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
  ADD KEY `fk_student_id` (`sic`);

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
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `facultyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sic_email`
--
ALTER TABLE `sic_email`
  MODIFY `seID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  ADD CONSTRAINT `fk_food_id` FOREIGN KEY (`foodID`) REFERENCES `food` (`foodID`) ON DELETE SET NULL;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_se_id` FOREIGN KEY (`seID`) REFERENCES `sic_email` (`seID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
