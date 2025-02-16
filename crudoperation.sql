-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 05:30 PM
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
-- Database: `crudoperation`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `company_name`, `email`, `contact`) VALUES
(3, 'Client 1', 'Company 1', 'client1@gmail.com', '9876514234'),
(5, 'Client 3', 'Company 3', 'client3@gmail.com', '9867452534');

-- --------------------------------------------------------

--
-- Table structure for table `inventory1`
--

CREATE TABLE `inventory1` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory1`
--

INSERT INTO `inventory1` (`id`, `name`, `Status`, `quantity`, `price`) VALUES
(27, 'Electric Heater', 'Available', 50, 700.00),
(28, 'Electric Boiler', 'Available', 25, 300.00),
(29, 'Washing Machine', 'Available', 15, 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `inventory2`
--

CREATE TABLE `inventory2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory2`
--

INSERT INTO `inventory2` (`id`, `name`, `Status`, `quantity`, `price`) VALUES
(1, 'Printer', 'Available', 15, 10000.00),
(2, 'Folders', 'Available', 100, 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `inventory3`
--

CREATE TABLE `inventory3` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory3`
--

INSERT INTO `inventory3` (`id`, `name`, `Status`, `quantity`, `price`) VALUES
(1, 'King Bed', 'Available', 10, 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `inventory4`
--

CREATE TABLE `inventory4` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory4`
--

INSERT INTO `inventory4` (`id`, `name`, `Status`, `quantity`, `price`) VALUES
(1, 'Fillet Knives', 'Available', 20, 900.00),
(2, 'Frying Pan', 'Available', 50, 250.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(15) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `order_description` text DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_name`, `client_contact`, `product_name`, `product_stock`, `order_description`, `order_date`) VALUES
(8, 'Client 2', '9764273655', 'Product 3', 7, 'Send in 7 days.', '2025-02-11 15:27:15'),
(12, 'Client 6', '9764273699', 'Product 3', 8, 'send to my address', '2025-02-12 15:26:26');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact`, `email`, `address`) VALUES
(2, 'Supplier 2', '9876512348', 'supplier2@gmail.com', 'Address 2'),
(4, 'Supplier 4', '9567843213', 'supplier4@gmail.com', 'Address 4'),
(5, 'Supplier 5', '9876473561', 'supplier5@gmail.com', 'Address 5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory1`
--
ALTER TABLE `inventory1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory2`
--
ALTER TABLE `inventory2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory3`
--
ALTER TABLE `inventory3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory4`
--
ALTER TABLE `inventory4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory1`
--
ALTER TABLE `inventory1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `inventory2`
--
ALTER TABLE `inventory2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory3`
--
ALTER TABLE `inventory3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory4`
--
ALTER TABLE `inventory4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
