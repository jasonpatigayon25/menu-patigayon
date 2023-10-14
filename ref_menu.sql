-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 04:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pointofsale`
--

-- --------------------------------------------------------

--
-- Table structure for table `ref_menu`
--

CREATE TABLE `ref_menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `menu_desc` varchar(1000) NOT NULL,
  `price` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ref_menu`
--

INSERT INTO `ref_menu` (`id`, `menu_name`, `menu_desc`, `price`) VALUES
(1, 'Chumpkin', 'Snack O Nice', '20.00'),
(3, 'Hello Biscuit', 'Description cya', '10.00'),
(4, 'Hello World', 'Hello2321312', '32.00'),
(5, 'Albertos Biscuit', 'Description ni cya, Albertos Biscuit ', '80.00'),
(6, 'Hollihee', 'This is a description. :D ', '15.00'),
(7, 'Sample Menu', 'Hello Description 123 I am a Lebron Fan', '30.00'),
(9, '123465', '123 I am a Lebron Fan', '70.00'),
(10, 'Menu123', 'MenuDescription123', '123.00'),
(12, 'Hello World Bread', 'DEscription 12312321321312321', '47.00'),
(14, 'Snapfire', 'Cookie with the dinosuar snacks', '99.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ref_menu`
--
ALTER TABLE `ref_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ref_menu`
--
ALTER TABLE `ref_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
