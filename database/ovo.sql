-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2019 at 12:20 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ovo`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_rewards`
--

CREATE TABLE `daily_rewards` (
  `id` int(11) NOT NULL,
  `reward_name` varchar(50) NOT NULL,
  `reward_code` varchar(50) NOT NULL,
  `reward_limit` double NOT NULL,
  `date_expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_rewards`
--

INSERT INTO `daily_rewards` (`id`, `reward_name`, `reward_code`, `reward_limit`, `date_expired`) VALUES
(1, 'OVOTODAY', 'OVOTODAY', 200000, '2019-10-02 07:00:00'),
(2, 'BAKULOVOJKT', 'BAKULOVOJKT', 300000, '2019-10-03 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `daily_reward_history`
--

CREATE TABLE `daily_reward_history` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_reward` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone_number`) VALUES
(1, 'Deni', '08120092345'),
(2, 'Gilbert', '08120092346'),
(3, 'Brandon', '08560092341'),
(4, 'There', '08770092345'),
(5, 'Jill', '08571192345'),
(6, 'Novan', '08781292341'),
(7, 'Lita', '08130092349'),
(8, 'Roy', '08110092346'),
(9, 'Steven', '08570092567'),
(10, 'Nelson', '08131112343');

-- --------------------------------------------------------

--
-- Table structure for table `user_rewards`
--

CREATE TABLE `user_rewards` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_reward` int(11) NOT NULL,
  `reward_amount_min` double NOT NULL,
  `reward_amount_max` double NOT NULL,
  `reward_amount_get` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rewards`
--

INSERT INTO `user_rewards` (`id`, `id_user`, `id_reward`, `reward_amount_min`, `reward_amount_max`, `reward_amount_get`) VALUES
(1, 1, 1, 30000, 40000, 0),
(2, 2, 1, 30000, 60000, 0),
(3, 3, 1, 40000, 70000, 0),
(4, 4, 1, 30000, 90000, 0),
(5, 5, 1, 10000, 20000, 0),
(6, 6, 1, 20000, 60000, 0),
(7, 7, 1, 20000, 60000, 0),
(8, 8, 1, 50000, 50000, 0),
(9, 9, 1, 40000, 100000, 0),
(10, 10, 1, 20000, 40000, 0),
(11, 1, 2, 20000, 30000, 0),
(12, 2, 2, 10000, 20000, 0),
(13, 3, 2, 30000, 50000, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_rewards`
--
ALTER TABLE `daily_rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_reward_history`
--
ALTER TABLE `daily_reward_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rewards`
--
ALTER TABLE `user_rewards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_rewards`
--
ALTER TABLE `daily_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daily_reward_history`
--
ALTER TABLE `daily_reward_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_rewards`
--
ALTER TABLE `user_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
