-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08 أبريل 2024 الساعة 03:01
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sixdiamonds`
--

-- --------------------------------------------------------

--
-- بنية الجدول `bill`
--

CREATE TABLE `bill` (
  `BillID` int(11) NOT NULL,
  `PriceBeforeVat` decimal(10,2) DEFAULT NULL,
  `PriceAfterVat` decimal(10,2) DEFAULT NULL,
  `BillDate` date DEFAULT NULL,
  `BillTime` time DEFAULT NULL,
  `DiscountValue` decimal(10,2) DEFAULT NULL,
  `DiscountPercentage` decimal(5,2) DEFAULT NULL,
  `VatPercentage` decimal(5,2) DEFAULT NULL,
  `VatValue` decimal(10,2) DEFAULT NULL,
  `PriceIncludeVat` decimal(10,2) DEFAULT NULL,
  `PriceTotExVat` decimal(10,2) DEFAULT NULL,
  `PriceTotAfterDiscount` decimal(10,2) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `billline`
--

CREATE TABLE `billline` (
  `BillQuantity` int(11) NOT NULL,
  `PrAfterVat` decimal(10,2) DEFAULT NULL,
  `PrBeforeVat` decimal(10,2) DEFAULT NULL,
  `BillItemDescription` text DEFAULT NULL,
  `DiscountPercentage` decimal(5,2) DEFAULT NULL,
  `DiscountValue` decimal(10,2) DEFAULT NULL,
  `VatValue` decimal(10,2) DEFAULT NULL,
  `VatPercentage` decimal(5,2) DEFAULT NULL,
  `PriceIncludeVat` decimal(10,2) DEFAULT NULL,
  `PrPriceExVat` decimal(10,2) DEFAULT NULL,
  `PricePrAfterDiscount` decimal(10,2) DEFAULT NULL,
  `PricePrIncludeVat` decimal(10,2) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT 1,
  `color` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `size`, `Quantity`, `color`, `user_id`) VALUES
(22, 8, 6, 1, 0, 5);

-- --------------------------------------------------------

--
-- بنية الجدول `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL,
  `CategoryImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`, `CategoryImage`) VALUES
(1, 'Bracelets', 'barno.jpg'),
(2, 'Necklaces', 'neckno.jpeg'),
(3, 'Earrings', 'earringno.jpeg'),
(4, 'Rings', 'ringno.jpeg');

-- --------------------------------------------------------

--
-- بنية الجدول `chat`
--

CREATE TABLE `chat` (
  `id` bigint(20) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `chatdate` datetime DEFAULT NULL,
  `msg` varchar(500) DEFAULT NULL,
  `UserID` int(11) DEFAULT 0,
  `type` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `chat`
--

INSERT INTO `chat` (`id`, `username`, `chatdate`, `msg`, `UserID`, `type`) VALUES
(148, 'llll@gmail.com', '2024-04-08 02:40:04', 'hi', 9, 0),
(149, 'llll@gmail.com', '2024-04-08 02:40:13', 'ggod', 9, 1),
(150, 'llll@gmail.com', '2024-04-08 02:41:29', 'you', 9, 1),
(151, 'llll@gmail.com', '2024-04-08 02:44:01', 'god', 9, 1),
(152, 'llll@gmail.com', '2024-04-08 02:44:32', 'yrty', 9, 0),
(153, '770730876luffy243402', '2024-04-08 02:59:19', 'hi', 10, 0),
(154, '770730876luffy243402', '2024-04-08 03:00:04', 'hi fg', 10, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `color`
--

INSERT INTO `color` (`id`, `name`) VALUES
(1, 'Silver'),
(2, 'Rose Gold'),
(3, 'Gold');

-- --------------------------------------------------------

--
-- بنية الجدول `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(255) DEFAULT NULL,
  `CustomerOrder` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `customerorders`
--

CREATE TABLE `customerorders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `Statue` varchar(255) DEFAULT 'progress',
  `PaymentMethod` varchar(255) DEFAULT NULL,
  `adress_id` int(11) DEFAULT NULL,
  `OrderDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `customerorders`
--

INSERT INTO `customerorders` (`OrderID`, `CustomerID`, `Statue`, `PaymentMethod`, `adress_id`, `OrderDate`) VALUES
(7, 5, 'waiting', 'Cash', 35, '2024-04-05 23:09:26'),
(8, 5, 'waiting', 'Cash', 36, '2024-04-05 23:10:43'),
(9, 5, 'waiting', 'Cash', 37, '2024-04-05 23:12:32'),
(10, 5, 'waiting', 'Cash', 38, '2024-04-05 23:13:29'),
(11, 5, 'waiting', 'Cash', 39, '2024-04-05 23:38:44'),
(12, 5, 'waiting', 'Cash', 40, '2024-04-05 23:39:26'),
(13, 5, 'waiting', 'Cash', 41, '2024-04-05 23:40:29');

-- --------------------------------------------------------

--
-- بنية الجدول `deliveryaddress`
--

CREATE TABLE `deliveryaddress` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `Neighborhood` varchar(255) NOT NULL,
  `Housenumber` varchar(255) NOT NULL,
  `Morelocationinfo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `deliveryaddress`
--

INSERT INTO `deliveryaddress` (`id`, `city`, `Street`, `Neighborhood`, `Housenumber`, `Morelocationinfo`) VALUES
(1, 'Jizan', 'eqe', 'qwe', 'eqwe', 'eqwe'),
(2, 'Riyadh', 'eqe', '234', '234', '4234'),
(3, 'Khamis Mushait', 'etet', 'ertet', 'etet', 'etet'),
(4, 'Riyadh', 'eqe', '234', '234', '4234'),
(5, 'Jeddah', 'tyu', 'ytu', 'tu', 'jghj'),
(6, 'Mecca', 'tyu', 'ytu', 'tu', 'jghj'),
(7, 'Sakakah', 'yry', 'yr', 'rty', 'ryry'),
(8, '', 'tyu', 'utyu', 'tyu', 'tyu'),
(9, 'Jeddah', 'jhj', 'hgjgh', 'jghj', 'hgjghj'),
(10, 'Riyadh', '424', '24', '24', '24'),
(11, 'Jeddah', 're', 'ewrwe', 'werwer', 'wrwr'),
(12, 'Jeddah', 'wer', 'wer', 'wer', 'wer'),
(13, '', '4534', '353', '3535', '5345'),
(14, '', '5345', '3453', '345', '3535'),
(15, 'Jeddah', 'ertert', 'erte', 'ertert', 'ertert'),
(16, 'Riyadh', '4534', '345', '34534', '34534'),
(17, 'Riyadh', '345', '353', '35345', '3534'),
(18, 'Mecca', 'ertert', 'ert', 'ert', 'ert'),
(19, 'Medina', 'ert', 'ert', 'terer', 'ertert'),
(20, '', 'rty', 'rty', 'rty', 'rty'),
(21, '', '', '', '', ''),
(22, 'Riyadh', 'ert', 'erte', 'ert', 'ert'),
(23, 'Mecca', 'ert', 'ert', 'ert', 'ert'),
(24, 'Jeddah', 'ert', 'ert', 'ert', 'ert'),
(25, 'Khamis Mushait', 'rty', 'rty', 'ry', 'rty'),
(26, 'Jeddah', 'et', 'ert', 'et', 'et'),
(27, 'Jeddah', '35', '35', '35', '345'),
(28, 'Riyadh', 'ert', 'tert', 'ert', 'ert'),
(29, 'Riyadh', 'et', 'ert', 'ert', 'et'),
(30, 'Riyadh', '45345', '345', '345', '345'),
(31, '', 'gerg', 'ger', 'ert', 'ertert'),
(32, 'Buraidah', '23', '213', '123', '132'),
(33, 'Medina', '687', '345', '35', '354'),
(34, 'Riyadh', '5345', '354', '35', '35'),
(35, 'Riyadh', 'tg', 'yty', 'rty', 'ry'),
(36, 'Riyadh', 'rty', 'rty', 'ryt', 'ry'),
(37, 'Riyadh', 'wert', 'tet', 'erte', 'ett'),
(38, 'Riyadh', '657', '567', '567', '57'),
(39, 'Riyadh', 'rt', 'reter', 'tert', 'et'),
(40, 'Riyadh', 'ert', 'ert', 'ert', 'etr'),
(41, 'Riyadh', 'yrt', 'rty', 'ry', 'ry');

-- --------------------------------------------------------

--
-- بنية الجدول `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductDescription` text DEFAULT NULL,
  `ProductBarCode` varchar(50) DEFAULT NULL,
  `PrPriceExVat` decimal(10,2) DEFAULT NULL,
  `PrDescription` text DEFAULT NULL,
  `FieldDiscountPercentage` decimal(5,2) DEFAULT NULL,
  `PrColor` varchar(50) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `ProImage` varchar(255) DEFAULT NULL,
  `ProductPrice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `UserPass` varchar(255) DEFAULT NULL,
  `UserAddress` varchar(255) DEFAULT NULL,
  `UserEmail` varchar(255) DEFAULT NULL,
  `UserTel` varchar(20) DEFAULT NULL,
  `UserRol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `UserPass`, `UserAddress`, `UserEmail`, `UserTel`, `UserRol`) VALUES
(6, 'admin', '$2y$10$2rLXZwxBUxyQLm1fqHRvrOzwTOUFQvNJD/Fsl7IJ/HyRI8LH/jxmW', 'admin', 'admin@gmail.com', '1234', 'admin'),
(7, '1234', '$2y$10$JO6q/pARuZNi7WzZy4E6kuoqG9HOcwDCR6u4C2qPpzsxO5.wI8aem', '770730876luffy2024@gmail.com', '770730876luffy2024@gmail.com', '324234', 'customer'),
(8, '770730876luffy204@gmail.com', '$2y$10$C4NDQK9ySuflOhjLJA52i.Rl9h6BTsKf4O/PoGOQpJT8u2L3YWN9K', 'trurturturtu', '770730876luffy204@gmail.com', '05464745', 'customer'),
(9, 'llll@gmail.com', '$2y$10$JUW3bXOFyeweyBIN8XTW7ePTF8Wf9jIFdl94FpYzAh9iIMnGNtzNy', 'trurturturtu', 'llll@gmail.com', '05464745', 'customer'),
(10, '770730876luffy2434024@gmail.com', '$2y$10$Mf9LEhPjhcSnoPD59TiuxuijS/L23fdGoQqKFmIueCahfIil9938K', '770730876luffy2434024@gmail.com', '770730876luffy2434024@gmail.com', '32323', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`BillID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `billline`
--
ALTER TABLE `billline`
  ADD PRIMARY KEY (`BillQuantity`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_ibfgbgk_1` (`UserID`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `customerorders`
--
ALTER TABLE `customerorders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `deliveryaddress`
--
ALTER TABLE `deliveryaddress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `BillID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billline`
--
ALTER TABLE `billline`
  MODIFY `BillQuantity` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerorders`
--
ALTER TABLE `customerorders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `deliveryaddress`
--
ALTER TABLE `deliveryaddress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);

--
-- قيود الجداول `billline`
--
ALTER TABLE `billline`
  ADD CONSTRAINT `billline_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- قيود الجداول `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfgbgk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- قيود الجداول `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- قيود الجداول `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
