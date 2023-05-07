-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 11:59 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customers`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `address` varchar(500) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `telephone`, `email`, `date`) VALUES
(1, 'john', 'smith', '07000000000', 'john@gmail.com', 1683404963),
(2, 'john1', 'smith1', '07000000000', 'john@gmail.com', 1683404963),
(3, 'john2', 'smith2', '07000000000', 'john@gmail.com', 1683404963),
(4, 'john3', 'smith3', '07000000000', 'john@gmail.com', 1683404963),
(5, 'john4', 'smith4', '07000000000', 'john@gmail.com', 1683404963),
(6, 'john5', 'smith5', '07000000000', 'john@gmail.com', 1683404963);

-- --------------------------------------------------------

--
-- Table structure for table `customers_note`
--

CREATE TABLE `customers_note` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers_note`
--

INSERT INTO `customers_note` (`id`, `user_id`, `note`, `date`) VALUES
(1, 1, 'this in a note for john smith!', 1683404990);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `customers_note`
--
ALTER TABLE `customers_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `customers_note`
--
ALTER TABLE `customers_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers_note`
--
ALTER TABLE `customers_note`
  ADD CONSTRAINT `customers_note_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
