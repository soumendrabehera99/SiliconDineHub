-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2025 at 09:00 PM
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
(1, 1, NULL),
(2, 2, NULL),
(3, 3, NULL);

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
(1, 'counter1', '123', '1'),
(2, 'counter2', '456', '1'),
(3, 'counter3', '789', '0');

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
  `price` varchar(255) NOT NULL,
  `isAvailable` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`foodID`, `foodCategoryID`, `name`, `image`, `description`, `price`, `isAvailable`) VALUES
(1, 1, 'Cappuccino', '', 'A classic hot coffee topped with thick milk foam, offering a rich taste and smooth texture with every sip, providing a satisfying morning boost.', '100', '1'),
(2, 1, 'Espresso', '', 'A strong and bold black coffee made from finely ground beans, delivering an intense caffeine kick and deep aroma, ideal for a quick energy boost.', '80', '1'),
(3, 1, 'Green Tea', '', 'A healthy and refreshing tea known for its rich antioxidants and light flavor, offering a calming and soothing experience with every warm, comforting sip.', '60', '0'),
(4, 2, 'Fried Rice', '', 'Stir-fried rice cooked with fresh vegetables, scrambled eggs, and soy sauce, creating a deliciously savory and aromatic dish that pairs well with spicy sides.', '120', '1'),
(5, 2, 'Manchurian', '', 'Crispy fried vegetable balls tossed in a flavorful spicy sauce, blending Chinese and Indian flavors for a delightful taste, perfect for an evening snack.', '140', '1'),
(6, 3, 'Masala Dosa', '', 'A thin crispy rice crepe filled with spiced mashed potatoes, served with coconut chutney and flavorful sambhar, making it a staple South Indian delicacy.', '110', '1'),
(7, 3, 'Idli Sambhar', '', 'Soft, fluffy steamed rice cakes served with spicy lentil soup and coconut chutney, offering a light and healthy meal that is both nutritious and delicious.', '90', '0'),
(8, 4, 'Paneer Butter Masala', '', 'A rich and creamy tomato-based curry made with soft paneer cubes, infused with aromatic spices and butter, making it a favorite vegetarian dish.', '180', '1'),
(9, 4, 'Curd Rice', '', 'A refreshing South Indian dish made with rice, yogurt, and mild spices, providing a cooling and light taste that is perfect for hot summer days.', '80', '1'),
(10, 5, 'Cheeseburger', '', 'A juicy grilled beef patty topped with melted cheese, fresh lettuce, tomato, and onions, all in a toasted bun, offering a deliciously filling fast food treat.', '150', '1'),
(11, 5, 'French Fries', '', 'Crispy golden potato fries seasoned with salt and served hot with ketchup or a creamy dipping sauce, making them a perfect side or snack choice.', '70', '0'),
(12, 6, 'Chocolate Cake', '', 'A moist and rich chocolate cake layered with creamy frosting, offering a delightful treat for chocolate lovers who enjoy indulgent and sweet desserts.', '200', '1'),
(13, 6, 'Ice Cream Sundae', '', 'A scoop of vanilla ice cream topped with nuts, syrup, fresh fruits, and a drizzle of chocolate sauce, providing a refreshing and sweet delight.', '130', '1'),
(14, 7, 'Croissant', '', 'A buttery and flaky French pastry with a crisp golden crust, best enjoyed fresh with a cup of coffee for a perfect morning or evening snack.', '90', '1'),
(15, 7, 'Banana Bread', '', 'A moist and sweet homemade bread infused with ripe bananas, offering a deliciously soft and comforting treat that pairs well with tea or coffee.', '90', '1'),
(16, 8, 'Caesar Salad', '', 'Crisp lettuce tossed with parmesan cheese, croutons, and a creamy dressing, creating a refreshing and crunchy dish perfect as a starter or side.', '150', '1'),
(17, 8, 'Greek Salad', '', 'A fresh mix of feta cheese, olives, tomatoes, cucumbers, and herbs, drizzled with olive oil for extra flavor, making it a nutritious and tasty meal.', '160', '1'),
(18, 9, 'Tomato Soup', '', 'A smooth and creamy tomato-based soup seasoned with herbs, offering a warm and comforting meal on chilly days, best served with crispy breadsticks.', '90', '1'),
(19, 9, 'Chicken Corn Soup', '', 'A warm and delicious soup made with tender chicken, sweet corn, and aromatic spices, perfect for cold evenings or as a starter for any meal.', '110', '1'),
(20, 10, 'Grilled Salmon', '', 'Fresh salmon fillet grilled to perfection, served with a lemon butter sauce, offering a flavorful and healthy option rich in protein and omega-3.', '300', '0'),
(21, 10, 'Prawn Curry', '', 'A flavorful and spicy prawn dish cooked with coconut milk, tomatoes, and traditional spices, served with rice for a perfect blend of taste and aroma.', '280', '1'),
(22, 11, 'Tacos', '', 'Soft tortillas filled with seasoned meat, fresh veggies, and salsa, providing a flavorful and satisfying meal, perfect for lunch or dinner.', '180', '1'),
(23, 11, 'Burrito', '', 'A large stuffed wrap with rice, beans, cheese, meat, and a flavorful sauce, wrapped in a warm tortilla, creating a hearty and filling meal.', '190', '1'),
(24, 12, 'Margherita Pizza', '', 'A classic pizza topped with tomato sauce, fresh mozzarella, and basil, baked to perfection for an authentic taste, loved by all pizza enthusiasts.', '220', '1'),
(25, 12, 'Pasta Alfredo', '', 'Creamy fettuccine pasta tossed in a rich, cheesy white sauce, topped with herbs and freshly grated parmesan, making it a comforting Italian dish.', '200', '1');

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
(15, 'Vegan');

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
(1, NULL, NULL, '2', 'dineIn', '200', '2025-02-12', '2025-02-12', '1'),
(2, 2, NULL, '1', 'parcel', '150', '2025-02-11', '2025-02-11', '1'),
(3, NULL, NULL, '2', 'dineIn', '200', '2025-02-12', '2025-02-12', '1');

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
(2, '23mmci48', 2, 'Soumendra', '2000-08-20', '5678', '1'),
(3, '23mmci76', 3, 'Priti', '2001-02-17', '1866', '0'),
(4, '23mmci87', 4, 'Himansu', '2001-06-20', '1478', '1'),
(5, '23mmci01', 5, 'Raj', '2002-01-15', 'abcd', '1'),
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
  MODIFY `counterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `foodCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
