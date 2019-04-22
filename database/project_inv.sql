-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 06, 2019 at 08:48 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `bid` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`bid`, `brand_name`, `status`) VALUES
(19, 'Samsung', '1'),
(20, 'Apple', '1'),
(21, 'L&T', '1'),
(22, 'Nike', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `parent_cat`, `category_name`, `status`) VALUES
(11, 0, 'Electronics', '1'),
(12, 0, 'Equipments', '1'),
(13, 0, 'Machinery', '1'),
(14, 0, 'Fabrics', '1');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_no` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `sub_total` double NOT NULL,
  `gst` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_type` tinytext NOT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `customer_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`, `userid`) VALUES
(55, 'Mukund Ramesh Vora', '2019-02-04', 2600000, 468000, 20000, 3048000, 2000000, 1048000, 'Cash', NULL),
(56, 'rohan', '2019-06-04', 756000, 136080, 0, 892080, 890000, 2080, 'Cash', NULL),
(57, 'rahil', '2019-06-04', 8560000, 1540800, 0, 10100800, 6846644, 3254156, 'Cash', NULL),
(58, 'rahil', '2019-06-04', 4160000, 748800, 0, 4908800, 800000, 4108800, 'Cash', NULL),
(59, 'rahil', '2019-06-04', 1600000, 288000, 0, 1888000, 651616, 1236384, 'Cash', NULL),
(60, 'rahil', '2019-06-04', 5750000, 1035000, 0, 6785000, 0, 6785000, 'Cash', NULL),
(61, 'rahil', '2019-07-04', 126000, 22680, 0, 148680, 0, 148680, 'Cash', NULL),
(62, 'Rahil', '2019-08-04', 2600000, 468000, 0, 3068000, 50, 3067950, 'Cash', NULL),
(63, 'Rohit', '2019-07-04', 1164000, 209520, 0, 1373520, 0, 1373520, 'Cash', NULL),
(64, 'Rohit', '2019-07-04', 5600000, 1008000, 0, 6608000, 0, 6608000, 'Cash', NULL),
(65, 'Rohit', '2019-07-04', 8756000, 1576080, 0, 10332080, 0, 10332080, 'Cash', NULL),
(66, 'Mukund Ramesh Vora', '2019-08-04', 2520000, 453600, 0, 2973600, 0, 2973600, 'Cash', NULL),
(67, 'Mohit', '2019-10-04', 6000000, 1080000, 0, 7080000, 0, 7080000, 'Cash', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `product_name`, `price`, `qty`) VALUES
(50, 55, 'S8', 52000, 50),
(51, 56, 'XS', 108000, 7),
(52, 57, 'Sneakers', 20000, 50),
(53, 57, 'XS', 108000, 70),
(54, 58, 'S8', 52000, 80),
(55, 59, 'Crane', 800000, 2),
(56, 60, 'Shoe Sole', 180, 500),
(57, 60, 'XS', 108000, 50),
(58, 60, 'S8', 52000, 5),
(59, 61, 'Shoe Sole', 180, 700),
(60, 62, 'S8', 52000, 50),
(61, 63, 'Crane', 800000, 1),
(62, 63, 'S8', 52000, 7),
(63, 64, 'Crane', 800000, 7),
(64, 65, 'Crane', 800000, 10),
(65, 65, 'XS', 108000, 7),
(66, 66, 'Shoe Sole', 180, 5000),
(67, 66, 'XS', 108000, 15),
(68, 67, 'Sneakers', 20000, 300);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` double NOT NULL,
  `product_stock` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `p_status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) VALUES
(19, 11, 19, 'S8', 52000, 786, '2018-10-31', '1'),
(20, 11, 20, 'XS', 108000, 208, '2019-04-06', '1'),
(21, 14, 22, 'Sneakers', 20000, 150, '2019-04-02', '1'),
(22, 13, 21, 'Crane', 800000, 10, '2019-04-06', '1'),
(24, 14, 22, 'Shoe Sole', 180, 1800, '2019-04-06', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `usertype` enum('Admin','Other') NOT NULL,
  `register_date` date NOT NULL,
  `last_login` datetime NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES
(10, 'rahil sheth', 'rahil@gmail.com', '$2y$08$P52DUbHRoBsuP61vDPVVqeNY0V/AJm2RAAx0idu5KcLzARMVJJw7G', 'Admin', '2018-10-31', '2018-10-31 01:10:56', ''),
(11, 'mukund vora', 'mukund@gmail.com', '$2y$08$I2o6yGSt76bOofPV9l3O8uMGrYwT3tPZSeU32fTXLaRVnOOTQuhi6', 'Admin', '2018-10-31', '2018-10-31 00:00:00', ''),
(12, 'Rahil sfin', 'rahil123@gmail.com', '$2y$08$7LCDK9mAvZw8egytxQSxVeJjqECkWsgy70yzKvcX98yuGiQABVpgu', 'Admin', '2018-10-31', '2018-10-31 00:00:00', ''),
(13, 'Rahil sfinrg', 'rahil1234@gmail.com', '$2y$08$5NTdfXErGgXxjG/dTncP5eoJAgstIsw8/tTbDdXNZ/Pe5u5bzR8aW', 'Admin', '2018-10-31', '2018-10-31 00:00:00', ''),
(14, 'rohit', 'rohit@gmail.com', '$2y$08$kG73GKzPgHgMW9sOFeEdbu9Fx2exltb3CkDxE1C6E1XHJn7naNIa2', 'Admin', '2018-10-31', '2018-10-31 03:10:39', ''),
(15, 'Rahil sfinrgrwver', 'rahil12345@gmail.com', '$2y$08$KBlyEKYvA6Drn2bSWYk2Y.12a.ZsJbr6a0ZPfbknbNF6hWBPt7Qkq', 'Admin', '2018-10-31', '2018-10-31 00:00:00', ''),
(16, 'Rahil Alkesh', 'rahil123456@gmail.com', '$2y$08$Zfweal78RQNoYORvTy38CezLSHi4Rkw9ioyBWo3Uh6KggUmfqlLSK', 'Admin', '2018-10-31', '2018-10-31 00:00:00', ''),
(17, 'Rahil Alkesh', 'rahil1234567@gmail.com', '$2y$08$LnCXcmgX6UBEZQTWlchLde5TzK94sYVS3BkANqljdcth9n9jPwLZ.', 'Admin', '2018-10-31', '2018-10-31 00:00:00', ''),
(18, 'Rahil Alkesh', 'rahil12345678@gmail.com', '$2y$08$Sfq4P8LkxcdahfybkjHwneDVjl1yVGdsFsmCUaAXSTFawjxaGpGQ2', 'Admin', '2018-10-31', '2018-10-31 00:00:00', ''),
(19, 'Rahil Alkesh', 'rahil123456789@gmail.com', '$2y$08$6UIIZAyjFIeJmDj8q0S3JOm44ojYI.KK7wcEg/m1ullp/Mv0xfWw2', 'Admin', '2018-10-31', '2018-10-31 00:00:00', ''),
(20, 'Rahil Alkesh', 'mukundvora@gmail.com', '$2y$08$0zVvXO9TRYhYbDzO.qJghuMiIwpymRrvUu4TvYowuXQB6H.NKQLUq', 'Admin', '2018-10-31', '2018-10-31 00:00:00', ''),
(21, 'rahil12345', 'rahil098@gmail.com', '$2y$08$P/Kss7pH6SXH2S9n6liFBOqiltM3V3LeRp./ohKrNJ3EKn/QYLdFm', 'Admin', '2019-04-01', '2019-04-06 07:04:52', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `brand_name` (`brand_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `cid` (`cid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `categories` (`cid`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `brands` (`bid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
