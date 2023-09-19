-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2023 at 12:08 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ommydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `username` varchar(100) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `phone` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `first_name`, `last_name`, `email`, `registration_date`, `amount`, `username`, `role_id`, `phone`) VALUES
(13, '$2y$10$trAaC0o6XQGTCX3TIcCLc.jlYmZJzv/macZreUxmbOY8T8mFV7X0a', 'yehoshaphati', 'joshua', 'yehoshaphatj@gmail.com', '2023-09-15 10:46:56', '3333.00', '0753720642', 2, 753720642),
(22, '$2y$10$kID4ZQzDlVymRnkvsJNWHOn3tjFgdAregG4Iw3D01ulLLazoTzQXi', 'admin', 'admin', 'admin@gmail.com', '2023-09-15 11:53:23', '7888965.00', '0672725612', 1, 672725612),
(25, '$2y$10$siAHcedF3i1KZZxdwKdxhOQvcBYwY0Qbsz84/lVF//hzfA44ZXRbu', 'omary', 'omary', 'omyy@gmail.com', '2023-09-15 12:37:36', '222222.00', '0679166512', 2, 679166512),
(46, '$2y$10$k39Cp8Ij4IMK089vipHBfeEFjD1uU1Rbkhbq92Y2jgAIY/w/iQ0aK', 'baraka', 'ibrahim', 'ibrab@gmail.com', '2023-09-15 20:22:17', '222222.00', '0788675432', 2, 788675432),
(47, '$2y$10$IWY1dwT5VbeiJEJottLV5ufdFVJsy.WMNFC4dQOQJtdCQxXXHQF5m', 'abc', 'alpha', 'alpha@gmail.com', '2023-09-16 00:26:19', '38888.00', '0672123456', 2, 672123456),
(48, '$2y$10$1XiWd8FTh9GEUOflhPE55eK0IVfCrgeLrk4vzZWuUxiq8PxLKJtx6', 'john', 'doe', 'john1@gmai.com', '2023-09-16 11:01:19', '12000000.00', '0624343654', 2, 624343654),
(49, '$2y$10$SRq.ACXGiPCYzUhxqR15s.3ZSJOx7FIXpLCbrdWA0kUAOmYtYLPEW', 'abc', 'abd', 'dddd@gmail.com', '2023-09-16 12:00:43', '50000.00', '0765444433', 2, 765444433);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
