-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 01:32 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `powerfuel`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `vehicle_no` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `vehicle_no`, `address`, `contact_number`, `last_login`, `is_deleted`) VALUES
(10, 'Matheesha', 'Amarasekara', 'matheesha@gmail.com', '789b49606c321c8cf228d17942608eff0ccc4171', '', '', 0, '2022-12-05 16:32:39', 0),
(14, 'shehan', 'pathirana', 'shehan@gmail.com', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'CEB1025', 'Colombo, Sri Lanka', 774589632, '0000-00-00 00:00:00', 0),
(15, 'Supun', 'Sachinthana', 'supun@gmail.com', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'CEB1111', 'Colombo, Sri Lanka', 774589632, '2022-12-05 17:56:01', 0),
(16, 'Bimal', 'Jayakodi', 'test@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '12354', 'Colombo, Sri Lanka', 774589632, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
